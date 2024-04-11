<?php

namespace App\Http\Controllers\Admin;

use App\DTO\MovieDTO;
use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Country;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\StreamingService;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private $movieService;

    public function __construct()
    {
        $this->movieService = new MovieService();
    }
    public function showMoviesAdminPanel(Request $request)
    {
        $admin = auth()->user();
        $movies = Movie::paginate(5);
        return view('admin.movies.movies',
            ['movies' => $movies, 'admin' => $admin]);
    }

    public function showCreateMovie(Request $request)
    {
        return view('admin.movies.createMovieForm');
    }

    public function createMovie(Request $request)
    {
        request()->validate($this->rules);
        $this->movieService->createMovie($this->getMovieFromRequest($request));
        return redirect()->route('admin.movies');
    }

    public function destroyMovie($id)
    {
        $this->movieService->deleteMovie($id);
        return redirect()->route('admin.movies');
    }

    public function showMovieDetails($id){
        $movie = Movie::findOrFail($id);
        $admin = auth()->user();
        $genres = Genre::all();
        $services = StreamingService::all();
        $countries = Country::all();

        return view('admin.movies.movieDetails',
            ['movie' => $movie, 'admin' => $admin,
                'genres' => $genres, 'streamingServices' => $services,
                'countries' => $countries]);
    }

    public function updateMovie(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:255',
            'synopsis' => 'required',
            'releaseDate' => 'required|date',
            'trailerURL' => 'required',
            'posterURL' => 'required',
            'backgroundImage' => 'required',
        ]);

        $movie = Movie::findOrFail($id);
        $movie->title = $request->input('title');
        $movie->synopsis = $request->input('synopsis');
        $movie->releaseDate = $request->input('releaseDate');
        $movie->trailer_link = $request->input('trailerURL');
        $movie->posterURL = $request->input('posterURL');
        $movie->background_image_link = $request->input('backgroundImage');
        $movie->save();
        return redirect()->route('admin.movies.show', $id)->with('message', 'Movie updated successfully');
    }

    public function removeDirector($movieId, $directorId)
    {
        $movie = Movie::findOrFail($movieId);
        $director = Director::findOrFail($directorId);
        if($movie->directors->contains($director->id)) {
            $movie->directors()->detach($director->id);
        }
        return redirect()->route('admin.movies.show', $movieId);
    }

    public function addDirector($movieId, $directorId)
    {
        $movie = Movie::findOrFail($movieId);
        $director = Director::findOrFail($directorId);

        if (!$movie->directors->contains($director->id)) {
            $movie->directors()->attach($director->id);
        }

        return redirect()->route('admin.movies.show', $movieId);
    }

    public function searchDirectors(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);
        $admin = auth()->user();
        $searchTerm = $request->input('search');
        $directors = Director::where('name', 'like', '%' . $searchTerm . '%')->get();
        $genres = Genre::all();
        $services = StreamingService::all();
        $countries = Country::all();

        return view('admin.movies.movieDetails', [
            'movie' => $movie,
            'admin' => $admin,
            'searchResults' => $directors,
            'genres' => $genres,
            'streamingServices' => $services,
            'countries' => $countries]);
    }

    public function removeActor($movieId, $actorId)
    {
        $movie = Movie::findOrFail($movieId);
        $actor = Actor::findOrFail($actorId);
        if($movie->actors->contains($actor->id)) {
            $movie->actors()->detach($actor->id);
        }
        return redirect()->route('admin.movies.show', $movieId);
    }

    public function addActor($movieId, $actorId)
    {
        $movie = Movie::findOrFail($movieId);
        $actor = Actor::findOrFail($actorId);

        if (!$movie->actors->contains($actor->id)) {
            $movie->actors()->attach($actor->id);
        }

        return redirect()->route('admin.movies.show', $movieId);
    }

    public function searchActors(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);
        $admin = auth()->user();
        $searchTerm = $request->input('searchActor');
        $actors = Actor::where('name', 'like', '%' . $searchTerm . '%')->get();
        $genres = Genre::all();
        $services = StreamingService::all();
        $countries = Country::all();

        return view('admin.movies.movieDetails', [
            'movie' => $movie,
            'admin' => $admin,
            'searchActorResults' => $actors,
            'genres' => $genres,
            'streamingServices' => $services,
            'countries' => $countries]);
    }

    public function updateGenres(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->genres()->sync($request->input('genres', []));
        return redirect()->route('admin.movies.show', $id)->with('message', 'Genres updated successfully');
    }

    public function updateStreamingServices(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->streamingServices()->sync($request->input('streamingServices', []));
        return redirect()->route('admin.movies.show', $id)->with('message', 'Streaming services updated successfully');
    }
    public function updateCountries(Request $request, $id)
    {
        $movie = Movie::findOrFail($id);
        $movie->countries()->sync($request->input('countries', []));
        return redirect()->route('admin.movies.show', $id)->with('message', 'Countries updated successfully');
    }

    public function searchCountries(Request $request, $movieId)
    {
        $movie = Movie::findOrFail($movieId);
        $admin = auth()->user();
        $searchTerm = $request->input('searchCountry');
        $countries = Country::where('name', 'like', '%' . $searchTerm . '%')->get();
        $genres = Genre::all();
        $services = StreamingService::all();

        return view('admin.movies.movieDetails', [
            'movie' => $movie,
            'admin' => $admin,
            'searchCountryResults' => $countries,
            'genres' => $genres,
            'streamingServices' => $services,
            'countries' => $countries]);
    }

    public function removeCountry($movieId, $countryId)
    {
        $movie = Movie::findOrFail($movieId);
        $country = Country::findOrFail($countryId);
        if($movie->countries->contains($country->id)) {
            $movie->countries()->detach($country->id);
        }
        return redirect()->route('admin.movies.show', $movieId);
    }

    public function addCountry($movieId, $countryId)
    {
        $movie = Movie::findOrFail($movieId);
        $country = Country::findOrFail($countryId);

        if (!$movie->countries->contains($country->id)) {
            $movie->countries()->attach($country->id);
        }

        return redirect()->route('admin.movies.show', $movieId);
    }
    public function getMovieFromRequest(Request $request) : MovieDTO
    {
        $movieDTO = new MovieDTO();

        if (request()->input('title')) {
            $movieDTO->setTitle($request->input('title'));
        }

        if (request()->input('synopsis')) {
            $movieDTO->setSynopsis($request->input('synopsis'));
        }

        if(request()->input('director')) {
            $movieDTO->setDirector($request->input('director'));
        }

        if(request()->input('year')) {
            $movieDTO->setYear($request->input('year'));
        }

        if(request()->input('duration')) {
            $movieDTO->setDuration($request->input('duration'));
        }

        if(request()->input('genre')) {
            $movieDTO->setGenre($request->input('genre'));
        }

        if(request()->input('country')) {
            $movieDTO->setCountry($request->input('country'));
        }

        if(request()->input('rating')) {
            $movieDTO->setRating($request->input('rating'));
        }

        if($request->has('image')) {
            $movieDTO->setPoster($request->image);
        }
        return $movieDTO;
    }
}
