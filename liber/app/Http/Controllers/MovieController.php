<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\MovieList;
use App\Models\Rating;
use App\Models\Review;
use App\Services\MoviesService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $moviesService;

    public function __construct()
    {
        $this->moviesService = new MoviesService();
    }
    public function moviesPage(Request $request)
    {
        $movies = $this->moviesService->getMoviesList();
        if(collect($request->all())->filter()->isNotEmpty()){
            $movies = $this->filterMovies($request, $movies);
        }
        $movies = $movies->paginate(2)->withQueryString();
        $countries = $this->moviesService->getCountriesWithMovies();
        $genres = $this->moviesService->getGenresList();
        $years = $this->moviesService->getMoviesReleaseYears();
        $streamingServices = $this->moviesService->getStreamingServicesList();

        return view('movies.moviesPage',
            ['movies' => $movies, 'countries' => $countries,
                'genres' => $genres, 'years' => $years, 'streamingServices' => $streamingServices]);
    }

    public function showMovieInfo($id)
    {
        $movie = Movie::findOrFail($id);
        $averageCritics = round($movie->getCriticAverageAttribute(), 1);
        $globalAverage = round($movie->getAverageRatingAttribute(), 1);
        $numberOfLists = $movie->movieLists()->count();
        $numberOfUsersWatched = $movie->watchedByUsers()->count();
        $numberOfReviews = $movie->reviews()->count();
        $userRating = null;
        if (auth()->check()) {
            $userRating = auth()->user()->ratings()->where('movie_id', $movie->id)->first();
            $userRating = $userRating ? $userRating->rating : null;
        }
        $userReview = null;
        if (auth()->check()) {
            $userReview = auth()->user()->reviews()->where('movie_id', $movie->id)->first();
            $userReview = $userReview ? $userReview->text : null;
        }

        $userMovieLists = null;
        if (auth()->check()) {
            $userMovieLists = auth()->user()->movieLists()->get();
        }

        $actors = $movie->actors()->get();
        $reviews = $movie->reviews()->get();

        return view('movies.movieInfo',
            ['movie' => $movie, 'averageCritics' => $averageCritics,
                'globalAverage' => $globalAverage, 'numberOfLists' => $numberOfLists,
                'numberOfUsersWatched' => $numberOfUsersWatched,
                'numberOfReviews' => $numberOfReviews, 'userRating' => $userRating,
                'userReview' => $userReview, 'userMovieLists' => $userMovieLists,
                'actors' => $actors, 'reviews' => $reviews]);
    }

    private function filterMovies($request, $movies) {
        if ($movies == null) {
            $movies = $this->moviesService->getMoviesList();
        }

        if($request->has('movie-title') && $request->input('movie-title') != '') {
            $movies = $movies->where('title', 'LIKE', '%' . $request->input('movie-title') . '%');
        }

        if($request->has('release-year') && $request->input('release-year') != '') {
            $movies = $movies->whereYear('releaseDate', $request->input('release-year'));
        }

        if($request->has('country') && $request->input('country') != '') {
            $movies = $movies->whereHas('countries', function ($query) use ($request) {
                $query->where('countries.id', $request->input('country'));
            });
        }

        if($request->has('genre') && $request->input('genre') != '') {
            $movies = $movies->whereHas('genres', function ($query) use ($request) {
                $query->where('genres.id', $request->input('genre'));
            });
        }

        if($request->has('streaming_service') && $request->input('streaming_service') != '') {
            $movies = $movies->whereHas('streamingServices', function ($query) use ($request) {
                $query->where('streaming_services.id', $request->input('streaming_service'));
            });
        }

        return $movies;
    }

    public function markAsWatched(Request $request, $id)
    {
        $user = auth()->user();
        $movie = Movie::findOrFail($id);

        if ($user->watchedMovies()->where('movie_id', $movie->id)->exists()) {
            $user->watchedMovies()->detach($movie->id);
            return back()->with('status', 'Movie removed from watched list');
        } else {
            $user->watchedMovies()->attach($movie->id);
            return back()->with('status', 'Movie marked as watched');
        }
    }

    public function rate(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|numeric|min:0|max:10',
        ]);

        $movie = Movie::findOrFail($id);
        $user = auth()->user();

        $rating = $user->ratings()->where('movie_id', $movie->id)->first();

        if ($rating) {
            // Si existe una calificación, actualiza su valor
            $rating->rating = $request->input('rating');
            $rating->save();
        } else {
            // Si no existe una calificación, crea una nueva
            $rating = new Rating();
            $rating->rating = $request->input('rating');
            $rating->user_id = $user->id;
            $rating->movie_id = $movie->id;
            $rating->save();
        }

        return back()->with('status', 'Movie rated successfully');
    }

    public function review(Request $request, $id)
    {
        $request->validate([
            'review' => 'required|string|max:500', // Ajusta las reglas de validación según tus necesidades
        ]);

        $movie = Movie::findOrFail($id);
        $user = auth()->user();

        $review = $user->reviews()->where('movie_id', $movie->id)->first();

        if ($review) {
            // Si existe una review, actualiza su valor
            $review->text = $request->input('review');
            $review->save();
        } else {
            // Si no existe una review, crea una nueva
            $review = new Review();
            $review->text = $request->input('review');
            $review->user_id = $user->id;
            $review->movie_id = $movie->id;
            $review->save();
        }

        return back()->with('status', 'Review submitted successfully');
    }

    public function toggleInList(Request $request, $idMovie, $idList)
    {
        $movie = Movie::findOrFail($idMovie);
        $list = MovieList::findOrFail($idList);

        if ($list->movies()->where('movie_id', $movie->id)->exists()) {
            $list->movies()->detach($movie->id);
            return back()->with('status', 'Movie removed from list');
        } else {
            $list->movies()->attach($movie->id);
            return back()->with('status', 'Movie added to list');
        }
    }
}
