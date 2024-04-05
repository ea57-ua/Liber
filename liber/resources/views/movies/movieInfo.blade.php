@extends('layouts.master')
@section('title', 'Liber - Movie Information')
@section('head')
    <meta property="og:title" content="{{ $movie->title }}"/>
    <meta property="og:description" content="Directed by
        @foreach($movie->directors as $key => $director)
            {{$director->name}}{{ $key < count($movie->directors) - 1 ? ', ' : '' }}
        @endforeach"/>
    <meta property="og:image" content="{{ $movie->posterURL }}"/>
    <meta property="og:url" content="{{ url()->current() }}"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:title" content="{{ $movie->title }}"/>
    <meta name="twitter:description" content="Directed by
        @foreach($movie->directors as $key => $director)
            {{$director->name}}{{ $key < count($movie->directors) - 1 ? ', ' : '' }}
        @endforeach"/>
    <meta name="twitter:image" content="{{ $movie->posterURL }}"/>
@endsection

@section('content')
    <style>
        .movie-trailer-section {
            background: linear-gradient(rgba(0, 0, 0, 0.5),
            rgba(0, 0, 0, 0.5)),
            url("{{ $movie->background_image_link }}") center center;
            background-size: cover;
            padding: 100px 60px;
            border-radius: 15px;
            overflow: hidden;
        }
    </style>

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
                <a href="{{ asset($movie->posterURL) }}"
                   data-gallery="portfolio-gallery-app" class="glightbox">
                    <img id="movie-poster" src="{{ asset($movie->posterURL) }}"
                         class="movie-poster" alt="Film poster">
                </a>
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
                        <a href="{{ route('moviesPage', ['release-year' => date('Y', strtotime($movie->releaseDate))]) }}">
                            <span class="movie-release-year">
                                {{ date('Y', strtotime($movie->releaseDate)) }}
                            </span>
                        </a>
                    </h1>
                    <span>Directed by</span>
                    @foreach($movie->directors as $key => $director)
                        <a href="{{route('directors.details', $director->id)}}" class="director-name">
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
                                    <a href="{{ route('moviesPage', ['genre' => $genre->id]) }}"
                                       class="movie-details-badge mr-1">
                                        {{ $genre->name }}
                                    </a>
                                @endforeach
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="mb-0 movies-details-label">Countries:</p>
                                @foreach($movie->countries as $country)
                                    <a href="{{ route('moviesPage', ['country' => $country->id]) }}"
                                       class="movie-details-badge mr-1">
                                        {{$country->name}}
                                    </a>
                                @endforeach
                            </div>

                            <div class="d-flex align-items-center">
                                <p class="mb-0 movies-details-label">Streaming Services:</p>
                                @foreach($movie->streamingServices as $service)
                                    <a href="{{ route('moviesPage', ['streaming_service' => $service->id]) }}"
                                       class="movie-details-badge mr-1">
                                        {{$service->name}}
                                    </a>
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

                                        <li>
                                            <button id="share-button" class="btn btn-block"
                                                    data-bs-toggle="#shareMovieModal"
                                                    data-movie-id="{{ $movie->id }}">
                                                <strong>Share</strong>
                                            </button>
                                        </li>
                                    </ul>
                                </div>

                                <!-- Modal para evaluar la película -->
                                <div class="modal fade" id="rateMovieModal" tabindex="-1"
                                     aria-labelledby="rateMovieModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="rateMovieModalLabel">
                                                    Rate {{$movie->title}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('movies.rate', $movie->id) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="rating" class="form-label">Rating (0-10)</label>
                                                        <input type="number" class="form-control" id="rating"
                                                               name="rating"
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
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST" action="{{ route('movies.review', $movie->id) }}">
                                                    @csrf
                                                    <div class="mb-3">
                                                        <label for="review" class="form-label">Your Review</label>
                                                        <textarea class="form-control" id="review" name="review"
                                                                  rows="3"
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

                                <!-- Modal para compartir la película -->
                                <div class="modal fade" id="shareMovieModal" tabindex="-1"
                                     aria-labelledby="shareMovieModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="shareMovieModalLabel">
                                                    Share {{$movie->title}}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">

                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="input-group mb-3">
                                                    <input type="text" id="movie-link" class="form-control" readonly>
                                                    <button class="btn btn-outline-secondary" type="button"
                                                            id="copy-movie-link-button">
                                                        <i class="bi bi-clipboard"></i>
                                                    </button>
                                                </div>
                                                <div id="share-links-container" class="share-links-container"></div>
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

        <!-- Sección de actores -->
        <div class="row mt-0">
            <section id="testimonials" class="testimonials">
                <div class="container" data-aos="fade-up">
                    <div class="slides-3 swiper" data-aos="fade-up" data-aos-delay="100">
                        <div class="swiper-wrapper">
                            @foreach($actors as $actor)
                                <div class="swiper-slide">
                                    <div class="testimonial-wrap">
                                        <div class="testimonial-item d-flex movie-actor-card">
                                            <div class="align-items-center">
                                                <a href="{{route('actors.details',$actor->id )}}">
                                                    <img src="{{$actor->photo}}"
                                                         class="img-fluid" alt="">
                                                    <div class="d-flex justify-content-center align-items-center">
                                                        <h3>{{$actor->name}}</h3>
                                                    </div>
                                                </a>
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

        <!-- Sección del trailer -->
        <div class="row mt-0">
            <section id="call-to-action" class="call-to-action">
                <div class="text-center movie-trailer-section" data-aos="zoom-out">
                    <a href="{{$movie->trailer_link}}" class="glightbox play-btn"></a>
                    <h3>Watch the trailer</h3>
                    <a class="cta-btn" href="{{$movie->trailer_link}}">Watch the trailer on Youtube</a>
                </div>
            </section>
        </div>

        <!-- Sección de reseñas -->
        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                <div class="swiper reviews-swiper">
                    <div class="swiper-wrapper">

                        @foreach($reviews as $review)
                            <div class="swiper-slide">
                                <div class="testimonial-wrap">
                                    <div class="testimonial-item">
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('users.publicProfile', $review->user->id)}}">
                                                <img src="{{$review->user->image}}"
                                                     class="testimonial-img flex-shrink-0" alt="">
                                            </a>
                                            <div>
                                                <a href="{{route('users.publicProfile', $review->user->id)}}">
                                                    <h3>{{$review->user->name}}</h3>
                                                </a>
                                                <div>
                                                @if($review->user->admin)
                                                    <div class="tooltip-container">
                                                        <i class="bi bi-person-gear reviewer-icon"></i>
                                                        <span class="tooltip-text">Admin user</span>
                                                    </div>
                                                @endif
                                                @if($review->user->critic)
                                                    <div class="tooltip-container">
                                                        <i class="bi bi-person-check reviewer-icon"></i>
                                                        <span class="tooltip-text">Critic user</span>
                                                    </div>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                        <p class="review-text">
                                            <i class="bi bi-quote quote-icon-left"></i>
                                            {{$review->text}}
                                            <i class="bi bi-quote quote-icon-right"></i>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            </div>
    </section>
@endsection

@push('scripts')
    <script>
        var swiper = new Swiper(".reviews-swiper", {
            slidesPerView: 3,
            spaceBetween: 30,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        var shareButton = document.getElementById('share-button');
        if (shareButton) {
            shareButton.addEventListener('click', function () {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                console.log('Share button clicked');
                var movieId = this.getAttribute('data-movie-id');

                fetch('/movies/' + movieId + '/share', {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                    .catch(error => console.error('Error:', error))
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error sharing movie:', data.error);
                        } else {
                            var shareLinksContainer = document.getElementById('share-links-container');
                            shareLinksContainer.innerHTML = '';

                            document.getElementById('movie-link').value = data.url;

                            for (var platform in data.shareComponent) {
                                if (platform !== 'copy') {
                                    var link = data.shareComponent[platform];
                                    var button = document.createElement('a');
                                    button.href = link;
                                    button.target = '_blank'; // Abrir en una nueva pestaña
                                    button.className = 'btn btn-auth m-2'; // Añadir clases de Bootstrap
                                    button.innerHTML = '<i class="share-links-item bi bi-' + platform + '"></i>';
                                    shareLinksContainer.appendChild(button);
                                }
                            }

                            var shareModalElement = document.getElementById('shareMovieModal');
                            var shareModal = bootstrap.Modal.getInstance(shareModalElement);
                            if (!shareModal) {
                                shareModal = new bootstrap.Modal(shareModalElement);
                            }
                            shareModal.show();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        }

        var copyMovieLinkButton = document.getElementById('copy-movie-link-button');
        if (copyMovieLinkButton) {
            copyMovieLinkButton.addEventListener('click', function () {
                var movieLink = document.getElementById('movie-link');
                movieLink.select();
                document.execCommand('copy');
            });
        }
    </script>
@endpush
