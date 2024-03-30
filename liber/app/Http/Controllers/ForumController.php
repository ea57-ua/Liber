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
            'text' => 'required_without:markdownContent|max:280',
            'markdownContent' => 'nullable|string',
        ]);

        $post = new Post();
        $post->text = $request->markdownContent != '' ? $request->markdownContent : $request->text;
        $post->user_id = auth()->id();
        $post->save();

        return redirect()->route('forumPage');
    }
}
