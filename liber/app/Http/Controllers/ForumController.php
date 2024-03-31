<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();

        return view('forum.forumIndex',
            ['posts' => $posts]);
    }

    public function createNewPost(Request $request) {
        $request->validate([
            'text' => 'required_without_all:markdownContent,images|nullable|max:280',
            'markdownContent' => 'required_without_all:text,images|nullable|string',
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
}
