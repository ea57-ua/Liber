<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\MovieList;
use App\Models\Rating;
use App\Models\Review;
use App\Models\StreamingService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Symfony\Component\Translation\t;

class MovieController extends Controller
{
    private function getMoviesReleaseYears(){
        $oldestYear = Carbon::parse(Movie::min('releaseDate'))->year;
        $newestYear = Carbon::parse(Movie::max('releaseDate'))->year;
        $years = range($oldestYear, $newestYear);
        return $years;
    }
    public function moviesPage(Request $request)
    {
        $movies = Movie::query();
        if(collect($request->all())->filter()->isNotEmpty()){
            $movies = $this->filterMovies($request, $movies);
        }
        $movies = $movies->paginate(8)->withQueryString();
        $countries = Country::whereHas('movies')->get();
        $genres = Genre::all();
        $years = $this->getMoviesReleaseYears();
        $streamingServices =  StreamingService::all();

        return view('movies.moviesPage',
            ['movies' => $movies, 'countries' => $countries,
                'genres' => $genres, 'years' => $years, 'streamingServices' => $streamingServices]);
    }

    private function getRelatesMoviesList($id){
        $movie = Movie::findOrFail($id);
        $directors = $movie->directors->pluck('id');
        $genres = $movie->genres->pluck('id');

        $relatedMovies = Movie::where(function ($query) use ($directors, $genres) {
            $query->whereHas('directors', function ($query) use ($directors) {
                $query->whereIn('directors.id', $directors);
            })
                ->orWhereHas('genres', function ($query) use ($genres) {
                    $query->whereIn('genres.id', $genres);
                });
        })
            ->where('movies.id', '!=', $id)
            ->get()->take(4);

        $relatedMovies = $relatedMovies->sortByDesc(function ($relatedMovie) use ($directors, $genres) {
            $matchingDirectors = $relatedMovie->directors->whereIn('id', $directors)->count();
            $matchingGenres = $relatedMovie->genres->whereIn('id', $genres)->count();
            return $matchingDirectors + $matchingGenres;
        });

        return $relatedMovies;
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
        $relatesMovies = $this->getRelatesMoviesList($id);

        return view('movies.movieInfo',
            ['movie' => $movie, 'averageCritics' => $averageCritics,
                'globalAverage' => $globalAverage, 'numberOfLists' => $numberOfLists,
                'numberOfUsersWatched' => $numberOfUsersWatched,
                'numberOfReviews' => $numberOfReviews, 'userRating' => $userRating,
                'userReview' => $userReview, 'userMovieLists' => $userMovieLists,
                'actors' => $actors, 'reviews' => $reviews,
                'relatesMovies' => $relatesMovies]);
    }

    private function filterMovies($request, $movies) {
        if ($movies == null) {
            $movies = Movie::query();
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
