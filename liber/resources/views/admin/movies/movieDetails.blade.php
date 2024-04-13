@extends('layouts.admin')
@section('title', 'LiberAdmin - Movie Information')
@section('content')
    <div class="pagetitle">
        <h1>Movie Details</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.movies')}}">Movies</a></li>
                <li class="breadcrumb-item active">Movie Details</li>
            </ol>
        </nav>
    </div>

    <div class="row">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning">
                    {{$error}}
                </div>
            @endforeach
        @endif
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
    </div>

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">

                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                        <img src="{{$movie->posterURL}}" alt="Profile">
                        <h2>{{$movie->title}}</h2>
                    </div>
                </div>

            </div>

            <div class="col-xl-8">

                <div class="card">
                    <div class="card-body pt-3">
                        <ul class="nav nav-tabs nav-tabs-bordered">

                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">
                                    Information
                                </button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Information</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Directors</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Actors</button>
                            </li>

                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#movie-config">Other</button>
                            </li>

                        </ul>
                        <div class="tab-content pt-2">

                            <div class="tab-pane fade show active profile-overview" id="profile-overview">
                                <h5 class="card-title">Synopsis</h5>
                                <p class="fst-italic">
                                    {{$movie->synopsis}}
                                </p>

                                <h5 class="card-title">Details</h5>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label ">Title</div>
                                    <div class="col-lg-9 col-md-8">
                                        <strong>
                                        <a href="{{route('movies.details', $movie->id)}}">
                                            {{$movie->title}}
                                        </a>
                                        </strong>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Directors</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->directors as $key => $director)
                                            <a href="{{route('directors.details', $director->id)}}">
                                                <strong>{{$director->name}}</strong>
                                            </a>{{ $key < count($movie->directors) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Genres</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->genres as $key => $genre)
                                                <strong>{{$genre->name}}</strong>
                                         {{ $key < count($movie->genres) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Actors</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->actors as $key => $actor)
                                            <a href="{{route('actors.details', $actor->id)}}">
                                                <strong>{{$actor->name}}</strong>
                                            </a>
                                            {{ $key < count($movie->actors) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Countries</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->countries as $key => $country)
                                            <strong>{{$country->name}}</strong>
                                            {{ $key < count($movie->countries) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Streaming services</div>
                                    <div class="col-lg-9 col-md-8">
                                        @foreach($movie->streamingServices as $key => $service)
                                            <strong>{{$service->name}}</strong>
                                            {{ $key < count($movie->streamingServices) - 1 ? ',' : '' }}
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Release date</div>
                                    <div class="col-lg-9 col-md-8">{{$movie->releaseDate}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Trailer URL</div>
                                    <div class="col-lg-9 col-md-8">
                                        <a href="{{$movie->trailer_link}}">
                                        {{$movie->trailer_link}}
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Poster URL</div>
                                    <div class="col-lg-9 col-md-8">{{$movie->posterURL}}</div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Background Image URL</div>
                                    <div class="col-lg-9 col-md-8">{{$movie->background_image_link}}</div>
                                    <div class="d-flex justify-content-center">
                                        <img src="{{$movie->background_image_link}}"
                                             class="mt-3 mb-3"
                                             alt="Background Image"
                                             style="width: 500px; height: auto;">
                                    </div>

                                </div>

                            </div>

                            <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                <!-- Profile Edit Form -->
                                <form action="{{route('admin.movies.update', $movie->id)}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-3">
                                        @if($errors->has('title'))
                                            @foreach($errors->get('title') as $error)
                                                <div class="alert alert-danger mt-2">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                        <label for="title" class="col-md-4 col-lg-3 col-form-label">Movie title</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="title" type="text" class="form-control"
                                                   id="title" value="{{old('title',$movie->title)}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        @if($errors->has('synopsis'))
                                            @foreach($errors->get('synopsis') as $error)
                                                <div class="alert alert-danger mt-2">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                        <label for="synopsis" class="col-md-4 col-lg-3 col-form-label">Synopsis</label>
                                        <div class="col-md-8 col-lg-9">
                                            <textarea name="synopsis" class="form-control"
                                                      id="synopsis" style="height: 100px">{{$movie->synopsis}}</textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        @if($errors->has('releaseDate'))
                                            @foreach($errors->get('releaseDate') as $error)
                                                <div class="alert alert-danger mt-2">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                        <label for="releaseDate" class="col-md-4 col-lg-3 col-form-label">Release Date</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="releaseDate" type="date" class="form-control" id="releaseDate"
                                                   value="{{$movie->releaseDate}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        @if($errors->has('trailerURL'))
                                            @foreach($errors->get('trailerURL') as $error)
                                                <div class="alert alert-danger mt-2">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                        <label for="trailerURL" class="col-md-4 col-lg-3 col-form-label">Trailer URL</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="trailerURL" type="text"
                                                   class="form-control" id="trailerURL"
                                                   value="{{$movie->trailer_link}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        @if($errors->has('posterURL'))
                                            @foreach($errors->get('posterURL') as $error)
                                                <div class="alert alert-danger mt-2">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                        <label for="posterURL" class="col-md-4 col-lg-3 col-form-label">Poster</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="posterURL" type="text"
                                                   class="form-control" id="posterURL"
                                                   value="{{$movie->posterURL}}">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        @if($errors->has('backgroundImage'))
                                            @foreach($errors->get('backgroundImage') as $error)
                                                <div class="alert alert-danger mt-2">
                                                    {{ $error }}
                                                </div>
                                            @endforeach
                                        @endif
                                        <label for="backgroundImage" class="col-md-4 col-lg-3 col-form-label">Background image</label>
                                        <div class="col-md-8 col-lg-9">
                                            <input name="backgroundImage" type="text"
                                                   class="form-control" id="backgroundImage"
                                                   value="{{$movie->background_image_link}}">
                                        </div>
                                    </div>

                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </form>

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-settings">

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Directors</label>
                                    <div class="col-md-8 col-lg-9">
                                        @foreach($movie->directors as $director)
                                            <button class="btn btn-primary">
                                                <strong>{{$director->name}}</strong>
                                                <a
                                                    href="{{route('admin.movies.removeDirector', ['movieId' => $movie->id, 'directorId' => $director->id])}}"
                                                    class="text-white">
                                                    <i class="bi bi-x-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Director search form -->
                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Add Director</label>
                                    <div class="col-md-8 col-lg-9">
                                        <form action="{{route('admin.movies.searchDirectors', $movie->id)}}"
                                              method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       name="search" placeholder="Search directors">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                <!-- Display search results -->
                                @if(isset($searchResults))
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-lg-9">
                                            @foreach($searchResults as $director)
                                                <button class="btn btn-secondary me-2">
                                                    <strong>{{$director->name}}</strong>
                                                    <a href="{{route('admin.movies.addDirector', ['movieId' => $movie->id, 'directorId' => $director->id])}}"
                                                       class="text-white">
                                                        <i class="bi bi-plus-circle" style="font-size: 14px;"></i>
                                                    </a>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <div class="tab-pane fade pt-3" id="profile-change-password">

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Actors</label>
                                    <div class="col-md-8 col-lg-9">
                                        @foreach($movie->actors as $actor)
                                            <button class="btn btn-primary">
                                                <strong>{{$actor->name}}</strong>
                                                <a
                                                    href="{{route('admin.movies.removeActor', ['movieId' => $movie->id, 'actorId' => $actor->id])}}"
                                                    class="text-white">
                                                    <i class="bi bi-x-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Director search form -->
                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Add Director</label>
                                    <div class="col-md-8 col-lg-9">
                                        <form action="{{route('admin.movies.searchActors', $movie->id)}}"
                                              method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       name="searchActor" placeholder="Search directors">
                                                <button type="submit"
                                                        class="btn btn-primary input-group-append">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                @if(isset($searchActorResults))
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-lg-9">
                                            @foreach($searchActorResults as $actor)
                                                <button class="btn btn-secondary me-2">
                                                    <strong>{{$actor->name}}</strong>
                                                    <a href="{{route('admin.movies.addActor', ['movieId' => $movie->id, 'actorId' => $actor->id])}}"
                                                       class="text-white">
                                                        <i class="bi bi-plus-circle" style="font-size: 14px;"></i>
                                                    </a>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="tab-pane fade pt-3" id="movie-config">
                                <div class="row mb-3">
                                    <form action="{{route('admin.movies.updateGenres', $movie->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Genres</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="row">
                                                    @php
                                                        $chunks = $genres->split(3);
                                                    @endphp
                                                    @foreach($chunks as $chunk)
                                                        <div class="col-md-4">
                                                            @foreach($chunk as $genre)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                           name="genres[]" value="{{$genre->id}}"
                                                                           id="genre{{$genre->id}}"
                                                                        {{ $movie->genres->contains($genre->id) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="genre{{$genre->id}}">
                                                                        {{$genre->name}}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Genres</button>
                                    </form>
                                </div>

                                <div class="row mb-3">
                                    <form action="{{route('admin.movies.updateStreamingServices', $movie->id)}}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="row mb-3">
                                            <label class="col-md-4 col-lg-3 col-form-label">Streaming Services</label>
                                            <div class="col-md-8 col-lg-9">
                                                <div class="row">
                                                    @php
                                                        $chunks = $streamingServices->split(3);
                                                    @endphp
                                                    @foreach($chunks as $chunk)
                                                        <div class="col-md-4">
                                                            @foreach($chunk as $service)
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox" name="streamingServices[]" value="{{$service->id}}"
                                                                           id="service{{$service->id}}" {{ $movie->streamingServices->contains($service->id) ? 'checked' : '' }}>
                                                                    <label class="form-check-label" for="service{{$service->id}}">
                                                                        {{$service->name}}
                                                                    </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Streaming Services</button>
                                    </form>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label">Countries</label>
                                    <div class="col-md-8 col-lg-9">
                                        @foreach($movie->countries as $country)
                                            <button class="btn btn-primary">
                                                <strong>{{$country->name}}</strong>
                                                <a
                                                    href="{{route('admin.movies.removeCountry', ['movieId' => $movie->id, 'countryId' => $country->id])}}"
                                                    class="text-white">
                                                    <i class="bi bi-x-circle" style="font-size: 14px;"></i>
                                                </a>
                                            </button>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-md-4 col-lg-3 col-form-label" for="searchCountry">Add Country</label>
                                    <div class="col-md-8 col-lg-9">
                                        <form action="{{route('admin.movies.searchCountries', $movie->id)}}"
                                              method="GET">
                                            <div class="input-group">
                                                <input type="text" class="form-control"
                                                       name="searchCountry" placeholder="Search countries">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="bi bi-search"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>

                                @if(isset($searchCountryResults))
                                    <div class="row mb-3">
                                        <div class="col-md-8 col-lg-9">
                                            @foreach($searchCountryResults as $country)
                                                <button class="btn btn-secondary me-2 mb-2">
                                                    <strong>{{$country->name}}</strong>
                                                    <a href="{{route('admin.movies.addCountry', ['movieId' => $movie->id, 'countryId' => $country->id])}}"
                                                       class="text-white">
                                                        <i class="bi bi-plus-circle" style="font-size: 14px;"></i>
                                                    </a>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
