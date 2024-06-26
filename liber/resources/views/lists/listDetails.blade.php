@extends('layouts.master')
@section('title', 'Liber - Movie List Details')
@section('content')

    @if($list->public == false && Auth::check() && Auth::user()->id != $list->user_id)
        <div class="container" style="margin-top: 120px; margin-bottom: 500px;">
            <div class="alert alert-info" role="alert">
                This list is private. You can't see the content.
            </div>
        </div>
    @else

        <div class="container celebrity-info-container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                    <a href="{{ asset($list->poster_image) }}"
                       data-gallery="portfolio-gallery-app" class="glightbox">
                        <img id="movie-poster" src="{{ asset($list->poster_image) }}"
                             class="movie-poster" alt="Actor photo">
                    </a>
                    @if($likesCount > 0)
                        <div class="d-flex justify-content-center align-items-center mt-2"
                             style="font-size: 24px">
                            <i class="bi bi-heart me-2" title="List likes"></i>
                            <strong>{{$likesCount}}</strong>
                            @if($list->watchlist)
                                <i class="bi bi-list-check ms-5"
                                   title="Watch-list"
                                   style="font-size: 35px;">
                                </i>
                            @endif
                        </div>
                    @endif
                </div>

                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                    <div class="celebrity-info">
                        <h1>{{$list->name}}</h1>
                        <div class="d-flex align-items-center align-middle">
                            <a href="{{ route('users.publicProfile', ['id' => $creator->id]) }}">
                                <img src="{{ asset($creator->image) }}"
                                     class="rounded-circle" style="width: 40px; height: 40px;">
                            </a>

                            <h3 class="ml-2 ms-2 list-creator-text">Created By
                                <a href="{{ route('users.publicProfile', ['id' => $creator->id]) }}"
                                   class="creator-name">{{$creator->name}}
                                </a>
                            </h3>
                        </div>

                        <div class="movies-details-separator"></div>

                        <div class="row mb-1">
                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                <div class="celebrity-description">
                                    <p>{{$list->description}}</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex align-items-center">
                            <p class="mb-0 movies-details-label">Genres:</p>
                            @foreach($genres as $genre)
                                <a href="{{ route('moviesPage', ['genre' => $genre->id]) }}"
                                   class="movie-details-badge mr-1">
                                    {{ $genre->name }}
                                </a>
                            @endforeach
                        </div>

                        <div class="row">
                            <div class="col-8">
                            </div>

                            <div class="col-4">
                                <div class="mt-5 d-flex flex-column align-items-center ">
                                    @if(Auth::check())
                                        <form action="{{ route('lists.toggleLike', $list->id) }}"
                                              method="POST">
                                            @csrf
                                            <button class="btn-auth">
                                                @if($list->likedByUsers->contains(Auth::user()))
                                                    <i class="bi bi-heart-fill"></i>
                                                    Unlike List
                                                @else
                                                    <i class="bi bi-heart"></i>
                                                    Like List
                                                @endif

                                            </button>
                                        </form>
                                    @endif
                                    <div>
                                        <button class="btn-auth py-2 mb-1"
                                                id="share-list-button"
                                                data-bs-toggle="modal"
                                                data-bs-target="#shareListModal"
                                                data-list-id="{{$list->id}}">
                                            <i class="bi bi-share-fill me-2"></i>
                                            Share
                                        </button>
                                    </div>
                                    @if(Auth::check() && Auth::user()->id == $list->user_id)
                                        <div>
                                            <button class="btn-auth py-2 mb-1"
                                                data-bs-toggle="modal"
                                                data-bs-target="#editListModal">
                                                <i class="bi bi-pen me-1"></i>
                                                Edit List Info
                                            </button>


                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <section id="movies" class="movies">
                <div data-aos="fade-up">
                    <div class="row gy-4">
                        @foreach($movies as $movie)
                            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                                <div class="movieCard">
                                    <div class="dropdown d-flex justify-content-end">
                                        <button class="btn" style="border: none;"
                                                type="button" id="dropdownMenuButton"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="bi bi-three-dots" style="font-size: 22px;"></i>
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a class="dropdown-item"
                                               href="{{ route('movies.details', ['id' => $movie->id]) }}">
                                                Go To Movie Page
                                                </a>
                                            </li>
                                            <li>
                                            @if(Auth::check() && Auth::user()->id == $list->user_id)
                                                <form action="{{ route('movies.toggleToList', ['idMovie' => $movie->id, 'idList' => $list->id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    <button type="submit" class="dropdown-item">
                                                        @if($list->watchlist)
                                                            Remove from watchlist
                                                        @else
                                                            Remove from list
                                                        @endif
                                                    </button>
                                                </form>

                                                @if($list->watchlist)
                                                    <form action="{{ route('movies.watched', ['id' => $movie->id]) }}"
                                                          method="POST">
                                                        @csrf
                                                        <button type="submit" class="dropdown-item">
                                                            {{ $creator->watchedMovies()->where('movie_id', $movie->id)->exists()
                                                            ? 'Mark as Unwatched' : 'Mark as Watched'  }}
                                                        </button>
                                                    </form>
                                                @endif
                                            @endif
                                            </li>
                                        </ul>
                                    </div>
                                    <a href="{{ route('movies.details', ['id' => $movie->id]) }}"
                                        style="position: relative;">
                                        <img src="{{$movie->posterURL}}" class="img-fluid" alt="Movie poster">
                                        @if($creator->watchedMovies()->where('movie_id', $movie->id)->exists())
                                            <i class="bi bi-check-circle-fill"
                                               style="position: absolute; top: -65%; right: 5%;font-size: 30px"></i>
                                        @endif
                                        <h4>{{$movie->title}}</h4>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

            <div class="modal fade" id="shareListModal" tabindex="-1"
                 aria-labelledby="shareListModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="shareListModalLabel">
                                Share list {{$list->name}}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close">

                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input type="text" id="list-link" class="form-control" readonly>
                                <button class="btn btn-outline-secondary" type="button"
                                        id="copy-list-link-button">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                            </div>
                            <div id="share-links-container" class="share-links-container"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="editListModal" tabindex="-1"
                 aria-labelledby="editListModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editListModalLabel">Edit List Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div id="imageError" class="alert alert-danger" style="display: none;"></div>

                            <form action="{{ route('lists.update', $list->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $list->name }}">
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description">{{ $list->description }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="poster_image" class="form-label">Poster Image</label>
                                    <input type="file" class="form-control" id="poster_image" name="poster_image">
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="public" name="public" value="1" @if($list->public) checked @endif>
                                    <label class="form-check-label" for="public">Public</label>
                                </div>
                                <div class="mb-3 form-check">
                                    <input type="checkbox" class="form-check-input" id="watchlist" name="watchlist" value="1" @if($list->watchlist) checked @endif>
                                    <label class="form-check-label" for="watchlist">Watchlist</label>
                                </div>
                                <div class="text-center">
                                    <button type="button" class="btn-auth" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn-auth">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection

@push('scripts')
<script>
    var shareButton = document.getElementById('share-list-button');
    if (shareButton) {
        shareButton.addEventListener('click', function () {
            console.log('Share button clicked');
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var listiD = this.getAttribute('data-list-id');
            console.log("List ID: " + listiD);
            fetch('/lists/' + listiD + '/share', {
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
                        console.error('Error sharing list:', data.error);
                    } else {
                        var shareLinksContainer = document.getElementById('share-links-container');
                        shareLinksContainer.innerHTML = '';

                        document.getElementById('list-link').value = data.url;

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

                        var shareModalElement = document.getElementById('shareListModal');
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

    var copyListLinkButton = document.getElementById('copy-list-link-button');
    if (copyListLinkButton) {
        copyListLinkButton.addEventListener('click', function () {
            var ListLink = document.getElementById('list-link');
            ListLink.select();
            document.execCommand('copy');
        });
    }

    document.getElementById('poster_image').addEventListener('change', function () {
        var file = this.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB
        var errorDiv = document.getElementById('imageError');

        if(file.size > maxSize) {
            errorDiv.textContent = 'The selected file is too large. Please select a file less than 2MB.';
            errorDiv.style.display = 'block';
            this.value = '';
        }else {
            errorDiv.style.display = 'none';
        }
    });
</script>
@endpush
