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
    <form class="d-flex  search-movies movie-search-form" action="" method="get">
        <input type="text" name="title" placeholder="Movie Title"
               class="search-input title-input">
        <select name="genre" class="search-select">
            <option value="">Genre</option>
            <!-- Añade tus opciones de género aquí -->
            <option value="action">Action</option>
            <option value="comedy">Comedy</option>
        </select>
        <select name="year" class="search-select">
            <option value="">Year</option>
            <!-- Añade tus opciones de año aquí -->
            <option value="2022">2022</option>
            <option value="2021">2021</option>>
        </select>
        <select name="country" class="search-select">
            <option value="">Country</option>
            <!-- Añade tus opciones de país aquí -->
            <option value="us">United States</option>
            <option value="uk">United Kingdom</option>
        </select>
        <select name="streaming_service" class="search-select">
            <option value="">Streaming Service</option>
            <!-- Añade tus opciones de servicio de streaming aquí -->
            <option value="netflix">Netflix</option>
            <option value="hulu">Hulu</option>
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
                            <i class="bi bi-star-fill"></i> <!-- Icono de estrella para la calificación -->
                            <p class="critic-rating">8.5</p> <!-- Calificación de los críticos -->
                            <i class="bi bi-star-fill"></i> <!-- Icono de estrella para la calificación -->
                            <p class="user-rating">9.0</p> <!-- Calificación de los usuarios -->
                        </div>
                    </div>
                </div>
                </a>
            </div>
        @endforeach
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
