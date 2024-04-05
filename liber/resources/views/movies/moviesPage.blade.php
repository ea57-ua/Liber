@extends('layouts.master')
@section('title', 'Liber - Movies List')
@section('content')

<section id="call-to-action" class="call-to-action">
    <div class="container text-center" data-aos="zoom-out">
        <h3>Find Your Favorite Movie</h3>
        <p> Explore our vast collection and find the movie you're looking for. </p>
        <a class="cta-btn" href="#movies-search">Browse Movies</a>
    </div>
</section>

<div id="movies-search" class="container">
    <form class="d-flex  search-movies movie-search-form" action="{{route('moviesPage')}}" method="GET">
        <input type="text" name="movie-title" placeholder="Movie Title"
               class="search-input title-input" value="{{request()->query('movie-title')}}">
        <select name="genre" class="search-select">
            <option value="">Genre</option>
            @foreach($genres as $genre)
                <option value="{{$genre->id}}"
                    {{ request()->query('genre') == $genre->id ? 'selected' : '' }}>
                    {{$genre->name}}
                </option>
            @endforeach
        </select>
        <select name="release-year" class="search-select">
            <option value="">Year</option>
            @foreach($years as $year)
                <option value="{{ $year }}"
                    {{ request()->query('release-year') == $year ? 'selected' : '' }}>
                    {{ $year }}
                </option>
            @endforeach
        </select>
        <select name="country" class="search-select">
            <option value="">Country</option>
            @foreach($countries as $country)
                <option value="{{ $country->id }}"
                    {{ request()->query('country') == $country->id ? 'selected' : '' }}>
                    {{ $country->name }}
                </option>
            @endforeach
        </select>
        <select name="streaming_service" class="search-select">
            <option value="">Streaming Service</option>
            @foreach($streamingServices as $service)
                <option value="{{ $service->id }}"
                    {{ request()->query('streaming_service') == $service->id ? 'selected' : '' }}>
                    {{ $service->name }}
                </option>
            @endforeach
        </select>
        <button type="submit" class="search-button">Search</button>
    </form>
</div>

<section id="movies" class="movies">

<div class="container" data-aos="fade-up">
    <div class="row gy-4">
        @foreach($movies as $movie)
            <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                <a href="{{ route('movies.details', ['id' => $movie->id]) }}">
                <div class="movieCard">
                    <img src="{{$movie->posterURL}}" class="img-fluid" alt="">
                    <h4>{{$movie->title}}</h4>
                    <div class="movie-info" style="display: none;">
                        <div class="movie-ratings">
                            <i class="bi bi-star-fill"></i>
                            <p class="critic-rating">
                                @isset($movie->critic_average)
                                    {{ $movie->critic_average }}
                                @else
                                    N/A
                                @endisset
                            </p>
                            <i class="bi bi-star-fill"></i>
                            <p class="user-rating">
                                @isset($movie->average_rating)
                                    {{$movie->average_rating}}
                                @else
                                    N/A
                                @endisset
                            </p>
                        </div>
                    </div>
                </div>
                </a>
            </div>
        @endforeach
    </div>
</div>
</section><!-- End Team Section -->

{{-- Pagination --}}
{{ $movies->links('components.pagination', ['paginator' => $movies]) }}
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var movieCards = document.querySelectorAll('.movieCard');

        movieCards.forEach(function(movieCard) {
            var movieInfo = movieCard.querySelector('.movie-info');
            if (movieInfo) { // Comprueba si movieInfo no es null
                movieCard.addEventListener('mouseover', function() {
                    movieInfo.style.display = 'block';
                });

                movieCard.addEventListener('mouseout', function() {
                    movieInfo.style.display = 'none';
                });
            }
        });
    });
</script>
