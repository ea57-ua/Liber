@extends('layouts.master')
@section('title', 'Liber - Director Information')
@section('content')
    <div class="container celebrity-info-container">
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-4">
                <a href="{{ asset($director->photo) }}"
                   data-gallery="portfolio-gallery-app" class="glightbox">
                    <img id="movie-poster" src="{{ asset($director->photo) }}"
                         class="movie-poster" alt="Director photo">
                </a>
            </div>

            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-8">
                <div class="celebrity-info">
                    <h1>{{$director->name}}</h1>
                    <div class="row mb-1">
                        <div class="col-sm-12 col-lg-12 col-xl-12">
                            <div class="celebrity-description">
                                <p>{{$director->description}}</p>
                            </div>
                        </div>
                    </div>

                    <div class="movies-details-separator"></div>


                    <div class="row">
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center">
                            <div class="movie-details-text d-flex flex-column align-items-center">
                                <p class="movie-ratings-text">{{ round($averageRatingCritics, 1) }}/10</p>
                                <p class="movie-rating-legend">Critics average</p>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 d-flex justify-content-center">
                            <div class="movie-details-text d-flex flex-column align-items-center">
                                <p class="movie-ratings-text">{{ round($averageRatingGlobal, 1) }}/10</p>
                                <p class="movie-rating-legend">Global average</p>
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
                            <a href="{{ route('movies.details', ['id' => $movie->id]) }}">
                                <div class="movieCard">
                                    <img src="{{$movie->posterURL}}" class="img-fluid" alt="">
                                    <h4>{{$movie->title}}</h4>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
