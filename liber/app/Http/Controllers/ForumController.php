<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        $posts = Post::withCount('replies')
            ->with(['replies' => function ($query) {
                $query->withCount('likes')
                    ->orderBy('likes_count', 'desc')
                    ->orderBy('created_at', 'desc')
                    ->take(3);
            }])
            ->get();

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

        // Check if the authenticated user is the author of the post
        if (Auth::user()->id !== $post->user_id) {
            return redirect()->back()->with('error', 'You are not authorized to delete this post.');
        }

        for ($i = 1; $i <= 4; $i++) {
            $imagePath = $post->{'image'.$i};
            if ($imagePath) {
                // Extract the file name from the image URL
                $fileName = basename($imagePath);
                // Build the full file path
                $filePath = public_path('images/post_images/' . $fileName);
                // Check if the file exists and delete it
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }

        $post->delete();
        // TODO: borrar imagenes de public

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
        $post = Post::find($id);
        // TODO salta 500 sin texto
        $reply = new Post();
        $reply->text = $request->input('reply');
        $reply->user_id = Auth::user()->id;
        $reply->parent_id = $post->id;
        $reply->save();

        return redirect()->back()->with('success', 'Reply added successfully.');
    }

    public function showPost($id)
    {
        $post = Post::withCount('replies')->find($id);

        return view('forum.postDetails', ['post' => $post]);
    }
}
