@extends('layouts.master')
@section('title', 'Liber - Movie Information')
@section('content')

    <div class="container movie-details-container">
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

        <div class="row">
            <div id="movie-poster-container" class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                <img id="movie-poster" src="{{ asset($movie->posterURL) }}"
                     class="movie-poster" alt="Film poster">
                <div class="d-flex justify-content-center align-items-center mt-2">
                    <p class="movies-details-stats" data-toggle="tooltip" title="Lists">
                        <i class="bi bi-list"></i>
                        <strong>{{$numberOfLists}}</strong>
                    </p>
                    <p class="movies-details-stats" data-toggle="tooltip" title="Users Watched">
                        <i class="bi bi-eye"></i>
                        <strong>{{$numberOfUsersWatched}}</strong>
                    </p>
                    <p class="movies-details-stats" data-toggle="tooltip" title="Users Reviewed">
                        <i class="bi bi-chat-square-text"></i>
                        <strong>{{$numberOfReviews}}</strong>
                    </p>
                </div>

            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8" id="movie-details-container">
                <div class="movie-details">
                    <h1>{{$movie->title}}
                        <a href="#">
                            <span class="movie-release-year">
                                {{ date('Y', strtotime($movie->releaseDate)) }}
                            </span>
                        </a> </h1>
                    <span>Directed by</span>
                    @foreach($movie->directors as $key => $director)
                        <a href="#" class="director-name">
                            <strong>{{$director->name}}</strong>
                        </a>{{ $key < count($movie->directors) - 1 ? ',' : '' }}
                    @endforeach

                    <div class="movies-details-separator"></div>

                    <div class="row">
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center">
                            <div class="movie-details-text d-flex flex-column align-items-center">
                                <p class="movie-ratings-text">{{$averageCritics}}/10</p>
                                <p class="movie-rating-legend">Critics average</p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center">
                            <div class="movie-details-text d-flex flex-column align-items-center">
                                <p class="movie-ratings-text">{{$globalAverage}}/10</p>
                                <p class="movie-rating-legend">Global average</p>
                            </div>
                        </div>
                    </div>

                    <div class="movies-details-separator"></div>

                    <div class="row">
                        <div class="col-sm-12 col-lg-12 col-xl-8">
                            <div class="movie-synopsis">
                                <p>{{$movie->synopsis}}</p>
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="mb-0 movies-details-label">Genres:</p>
                                @foreach($movie->genres as $genre)
                                    <a href="#" class="movie-details-badge mr-1">{{$genre->name}}</a>
                                @endforeach
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="mb-0 movies-details-label">Countries:</p>
                                @foreach($movie->countries as $country)
                                    <a href="#" class="movie-details-badge mr-1">{{$country->name}}</a>
                                @endforeach
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="mb-0 movies-details-label">Streaming Services:</p>
                                @foreach($movie->streamingServices as $service)
                                    <a href="#" class="movie-details-badge mr-1">{{$service->name}}</a>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-sm-12 col-lg-12 col-xl-4">
                            @auth
                                <div class="user-actions">
                                    <ul class="list-unstyled">
                                        <li>
                                            <form method="POST" action="{{ route('movies.watched', $movie->id) }}">
                                                @csrf
                                                <button type="submit" class="btn btn-block">
                                                    <strong>{{ auth()->user()->watchedMovies()->where('movie_id', $movie->id)->exists()
                                                             ? 'Watched already' : 'Mark as Watched' }}
                                                    </strong>
                                                </button>
                                            </form>
                                        </li>

                                        <li>
                                            <button class="btn btn-block" data-bs-toggle="modal"
                                                    data-bs-target="#addToListModal">
                                                <strong>Add to List</strong>
                                            </button>
                                        </li>

                                        <li>
                                            <button class="btn btn-block" data-bs-toggle="modal"
                                                    data-bs-target="#rateMovieModal">
                                                <strong>Rate movie</strong>
                                            </button>
                                        </li>
                                        <li>
                                            <button class="btn btn-block" data-bs-toggle="modal"
                                                    data-bs-target="#reviewMovieModal">
                                                <strong>Review</strong>
                                            </button>
                                        </li>
                                        <li><button class="btn btn-block"><strong>Share</strong></button></li>
                                    </ul>
                                </div>

                                <!-- Modal para evaluar la película -->
                                <div class="modal fade" id="rateMovieModal" tabindex="-1"
                                     aria-labelledby="rateMovieModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rateMovieModalLabel">Rate {{$movie->title}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('movies.rate', $movie->id) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="rating" class="form-label">Rating (0-10)</label>
                                                        <input type="number" class="form-control" id="rating" name="rating"
                                                               min="0" max="10" step="0.1"
                                                               value="{{ $userRating }}" required>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para escribir la review -->
                                <div class="modal fade" id="reviewMovieModal" tabindex="-1"
                                     aria-labelledby="reviewMovieModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="reviewMovieModalLabel">Write a Review</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('movies.review', $movie->id) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="review" class="form-label">Your Review</label>
                                                        <textarea class="form-control" id="review" name="review" rows="3"
                                                                  required>{{$userReview}}</textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal para añadir a la lista -->
                                <div class="modal fade" id="addToListModal" tabindex="-1"
                                     aria-labelledby="addToListModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="addToListModalLabel">Add to List</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                @foreach($userMovieLists as $list)
                                                    <form method="POST"
                                                          action="{{ route('movies.toggleToList', ['idMovie' => $movie->id, 'idList' => $list->id]) }}">
                                                        @csrf
                                                        <button type="submit" class="btn btn-auth btn-block">
                                                            {{ $list->name }}
                                                            @if($list->movies()->where('movie_id', $movie->id)->exists())
                                                                <i class="bi bi-check-circle-fill"></i>
                                                            @endif
                                                        </button>
                                                    </form>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endauth
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="row mt-0">
            <section id="testimonials" class="testimonials">
                <div class="container" data-aos="fade-up">
                    <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            @foreach($actors as $actor)
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item d-flex">
                                            <div class="align-items-center">
                                                <img src="{{ asset('img/testimonials/testimonials-1.jpg') }}"
                                                     class="img-fluid" alt=""
                                                     style="border-radius: 10px; overflow: hidden;">
                                                <div class="d-flex justify-content-center align-items-center">
                                                    <h3>{{$actor->name}}</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="swiper-pagination"></div>
                    </div>

                </div>
            </section>

        </div>

    </div>

@endsection

