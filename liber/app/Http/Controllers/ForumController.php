<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $posts = null;

        if ($user) {
            $followingIds = $user->follows()->pluck('follows.followed_id')->toArray();

            // posts de los usuarios a los que sigue el usuario logueado
            $followingPosts = Post::whereIn('user_id', $followingIds)
                ->withCount('likes')
                ->orderBy('created_at', 'desc')
                ->orderBy('likes_count', 'desc')
                ->get();

            // posts de los usuarios a los que sigue el usuario logueado
            $notFollowingPosts = Post::whereNotIn('user_id', $followingIds)
                ->withCount('likes')
                ->orderBy('created_at', 'desc')
                ->orderBy('likes_count', 'desc')
                ->get();

            $posts = $followingPosts->concat($notFollowingPosts);

            // ordenar los posts de acuerdo a si mencionan al usuario logueado
            $posts = $posts->sort(function ($a, $b) use ($user) {
                $aMention = strpos($a->text, '@' . $user->name) !== false;
                $bMention = strpos($b->text, '@' . $user->name) !== false;

                if ($aMention && $bMention) {
                    return $b->created_at->timestamp - $a->created_at->timestamp;
                } elseif ($aMention) {
                    return -1;
                } elseif ($bMention) {
                    return 1;
                } else {
                    return $b->created_at->timestamp - $a->created_at->timestamp;
                }
            });

        } else {
            $posts = Post::withCount('replies')
                ->with(['replies' => function ($query) {
                    $query->withCount('likes')
                        ->orderBy('likes_count', 'desc')
                        ->orderBy('created_at', 'desc')
                        ->take(3);
                }])
                ->get();
        }

        return view('forum.forumIndex',
            ['posts' => $posts]);
    }

    public function createNewPost(Request $request) {
        $request->validate([
            'text' => 'required_without_all:markdownContent,images|nullable|max:1000',
            'markdownContent' => 'required_without_all:text,images|nullable|string|max:1000',
            'images' => 'required_without_all:text,markdownContent|sometimes|array|max:4',
        ]);

        $post = new Post();
        if ($request->markdownContent != '' || $request->text != '') {
            $post->text = $request->markdownContent != '' ? $request->markdownContent : $request->text;
        } else {
            $post->text = ' ';
        }
        $post->user_id = auth()->id();
        $post->image1 = null;
        $post->image2 = null;
        $post->image3 = null;
        $post->image4 = null;

        // Check if images were uploaded
        if ($request->hasFile('images')) {
            $images = $request->file('images');
            for ($i = 0; $i < count($images); $i++) {
                // Generate a unique file name
                $fileName = uniqid() . '.' . $images[$i]->getClientOriginalExtension();
                // Move the image to the public/images/post_images directory
                $images[$i]->move(public_path('images/post_images'), $fileName);
                // Build the image URL
                $imageUrl = asset('images/post_images/' . $fileName);
                // Assign the image URL to the corresponding field in the post
                $post->{'image' . ($i + 1)} = $imageUrl;
            }
        }

        $post->save();

        return redirect()->route('forumPage');
    }

    public function deletePost($id)
    {
        $post = Post::find($id);

        // Check if the authenticated user is the author of the post or an admin
        if ((Auth::user()->id !== $post->user_id) && !Auth::user()->admin ){
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        for ($i = 1; $i <= 4; $i++) {
            $imagePath = $post->{'image'.$i};
            if ($imagePath) {
                $fileName = basename($imagePath);
                $filePath = public_path('images/post_images/' . $fileName);
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $post->delete();

        return redirect()->route('forumPage')->with('success', 'Post deleted successfully.');
    }

    public function likeUnlikePost($id)
    {
        $post = Post::findOrFail($id);

        if($post->likes->contains(Auth::user()->id)) {
            $post->likes()->detach(Auth::user()->id);
            return response()->json(['liked' => false]);
        } else {
            $post->likes()->attach(Auth::user()->id);
            return response()->json(['liked' => true]);
        }
    }

    public function searchUsers(Request $request)
    {
        $search = $request->get('search');
        $users = User::where('name', 'like', '%' . $search . '%')->get();

        return response()->json($users);
    }

    public function replyPost(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required',
        ]);

        $post = Post::find($id);
        $reply = new Post();
        $reply->text = $request->input('reply');
        $reply->user_id = Auth::user()->id;
        $reply->parent_id = $post->id;
        $reply->save();

        return redirect()->back()->with('success', 'Reply added successfully.');
    }

    public function showPost($id)
    {
        $post = Post::withCount('replies')->findOrFail($id);

        return view('forum.postDetails', ['post' => $post]);
    }

    public function reportPost(Request $request, $id)
    {
        $post = Post::find($id);

        // Validate the request data
        $request->validate([
            'reason' => 'required',
            'category' => 'required',
        ]);

        // Create a new report
        $report = new Report();
        $report->reason = $request->input('reason');
        $report->category = $request->input('category');
        $report->post_id = $post->id;
        $report->user_id = Auth::user()->id;
        $report->save();

        return redirect()->back()->with('success', 'Post reported successfully.');
    }

}
