<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieList;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $recommendedMovies = null;
        if(auth()->check()) {
            $favoriteGenres = auth()->user()->favoriteGenres()->pluck('genres.id');

            $recommendedMovies = Movie::whereHas('genres', function ($query) use ($favoriteGenres) {
                $query->whereIn('genres.id', $favoriteGenres);
            })
                ->withCount(['ratings as average_rating' => function ($query) {
                    $query->select(\DB::raw('coalesce(avg(rating),0)'));
                }])
                ->orderByDesc('average_rating')
                ->take(4)
                ->get();


            if ($recommendedMovies->count() < 4) {
                $additionalMoviesNeeded = 4 - $recommendedMovies->count();

                $additionalMovies = Movie::whereNotIn('id', $recommendedMovies->pluck('id'))
                    ->withCount(['ratings as average_rating' => function ($query) {
                        $query->select(\DB::raw('coalesce(avg(rating),0)'));
                    }])
                    ->inRandomOrder()
                    ->take($additionalMoviesNeeded)
                    ->get();

                $recommendedMovies = $recommendedMovies->concat($additionalMovies);
            }
        }

        $popularMovies = Movie::withCount('watchedByUsers')
            ->orderBy('watched_by_users_count', 'desc')
            ->take(4)
            ->get();

        $popularLists = MovieList::where('public', true)
            ->withCount('likedByUsers')
            ->orderBy('liked_by_users_count', 'desc')
            ->take(4)
            ->get();

        return view('welcome', [
            'popularMovies' => $popularMovies,
            'popularLists' => $popularLists,
            'recommendedMovies' => $recommendedMovies]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return view('search_results',
                ['movies' => collect(), 'users' => collect(), 'lists' => collect(), 'query' => $query]);
        }

        $movies = Movie::where('title', 'LIKE', "%{$query}%")->get();
        $users = User::where('name', 'LIKE', "%{$query}%")->get();
        $lists = MovieList::where('name', 'LIKE', "%{$query}%")->get();

        return view('search_results',
            ['movies' => $movies, 'users' => $users, 'lists' => $lists, 'query' => $query]);
    }
}
