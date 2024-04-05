@extends('layouts.master')
@section('title', 'Liber - Welcome')
@section('content')

    <section id="hero" class="hero withImage">
        <div class="container position-relative">
            <div class="row gy-5 mt-4" data-aos="fade-in" >
                <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center text-center text-lg-start">
                    <h2>Welcome to <span>Liber</span></h2>
                    <p>Get Movie Recomendations And Share Opinions With Other Cinelovers</p>
                </div>
            </div>
        </div>

        <div class="icon-boxes position-relative">
            <div class="container position-relative">
                <div class="row gy-4 mt-5">

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-search"></i></div>
                            <h4 class="title"><a href="{{route('moviesPage')}}" class="stretched-link">Discover movies</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-people"></i></div>
                            <h4 class="title"><a href="{{route('forumPage')}}" class="stretched-link">Connect with cinephiles</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-star"></i></div>
                            <h4 class="title"><a href="{{route('moviesPage')}}" class="stretched-link">Rate films</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                    <div class="col-xl-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="icon-box">
                            <div class="icon"><i class="bi bi-card-checklist"></i></div>
                            <h4 class="title"><a href="{{route('listsPage')}}" class="stretched-link">Share your lists</a></h4>
                        </div>
                    </div><!--End Icon Box -->

                </div>
            </div>
        </div>

    </section>

    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2 style="font-size: 40px">Popular Movies</h2>
            </div>

            <div class="row gy-4 movies">
                @foreach($popularMovies as $movie)
                <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                    <a href="{{route('movies.details', $movie->id)}}">
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

    <section id="listsContainer" class="listsContainer">
        <div class="container text-center" data-aos="zoom-out">
            <h3>Craft Your Cinematic Universe</h3>
            <h3>Share, Inspire And Explore</h3>
        </div>
    </section>

    <section id="team" class="team">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <h2 style="font-size: 40px">Must-see Lists</h2>
            </div>

            <div class="row gy-4 movies">
                @foreach($popularLists as $list)
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{route('lists.details', $list->id)}}">
                            <div class="movieCard">
                                <img src="{{$list->poster_image}}" class="img-fluid" alt="">
                                <h4>{{$list->name}}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section id="listsContainer" class="listsContainer">
        <div class="container connectSection text-center" data-aos="zoom-out">
            <div style="position: absolute; bottom: 0;">
                <h3>Connect With Cinephiles Like</h3>
                <h3>You On This Platform</h3>
            </div>
        </div>
    </section>

@endsection
