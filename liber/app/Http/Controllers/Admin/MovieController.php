<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Actor;
use App\Models\Country;
use App\Models\Director;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\StreamingService;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function showMoviesAdminPanel(Request $request)
    {
        $admin = auth()->user();
        $query = $request->query('query');
        if ($query) {
            $movies = Movie::where('title', 'like', '%' . $query . '%')->paginate(10);
        } else {
            $movies = Movie::paginate(10);
        }

        return view('admin.movies.movies',
            ['movies' => $movies, 'admin' => $admin]);
    }

    public function showCreateMovie(Request $request)
    {
        $admin = auth()->user();
        return view('admin.movies.createMovieForm', ['admin' => $admin]);
    }

    public function createMovie(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'required|string',
            'year' => 'required|date',
            'posterURL' => 'required|url',
            'trailerURL' => 'required|url',
            'backgroundURL' => 'required|url',
        ]);

        $movie = new Movie();
        $movie->title = $request->input('title');
        $movie->synopsis = $request->input('synopsis');
        $movie->releaseDate = $request->input('year');
        $movie->posterURL = $request->input('posterURL');
        $movie->trailer_link = $request->input('trailerURL');
        $movie->background_image_link = $request->input('backgroundURL');
        $movie->save();

        return redirect()->route('admin.movies');
    }

    public function destroyMovie($id)
    {
        $movie = Movie::findOrFail($id);
        $movie->delete();
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
}
