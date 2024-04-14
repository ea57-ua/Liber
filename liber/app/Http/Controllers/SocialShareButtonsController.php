<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieList;
use App\Models\Post;
use Illuminate\Http\Request;

class SocialShareButtonsController extends Controller
{
    public function __invoke()
    {
        $shareComponent = \Share::page(
            'https://pranabkalita.com/posts/mastering-laravel-macros-a-comprehensive-guide',
            'Your share text comes here',
        )
            ->facebook()
            ->twitter()
            ->linkedin()
            ->telegram()
            ->whatsapp()
            ->reddit();

        return view('components.post', compact('shareComponent'));
    }

    public function shareMovie($id)
    {
        try {
            $movie = Movie::findOrFail($id);
            $url = route('movies.details', $id);
            $shareComponent = \Share::page($url, $movie->title)
                ->facebook()
                ->twitter()
                ->reddit();

            return response()->json(['shareComponent' => $shareComponent->getRawLinks(), 'url' => $url]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function shareMovieList($id){
        try {
            $list = MovieList::findOrFail($id);
            $url = route('lists.details', $id);
            $shareComponent = \Share::page($url, $list->name)
                ->facebook()
                ->twitter()
                ->reddit();

            return response()->json(['shareComponent' => $shareComponent->getRawLinks(), 'url' => $url]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function shareForumPost($id){
        try {
            $post = Post::findOrFail($id);
            $url = route('forum.showPost', $id);
            $shareComponent = \Share::page($url, "Check out this post by {$post->user->name}")
                ->facebook()
                ->twitter()
                ->reddit();

            return response()->json(['shareComponent' => $shareComponent->getRawLinks(), 'url' => $url]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
