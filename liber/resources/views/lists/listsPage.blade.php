@extends('layouts.master')
@section('title', 'Liber - Movie Lists Page')
@section('content')

    <section id="call-to-action" class="call-to-action listsPageImage">
        <div class="container text-center" data-aos="zoom-out">
            <h3>Find And Share Movie Lists</h3>
            <p> Explore our vast collection and find the movie you're looking for. </p>
            <a class="cta-btn lists-page-button" href="#lists">Browse Lists</a>
        </div>
    </section>

    <section id="lists" class="movies">

        <div class="container" data-aos="fade-up">
            <div class="row gy-4">
                @if($lists->isEmpty())
                    <div class="col-12 d-flex justify-content-center align-items-center"
                         style="height: 20vh;">
                        <div class="text-center">
                            <h2 class="display-4">No lists found</h2>
                            <p class="lead">Try browsing lists later.</p>
                        </div>
                    </div>
                @endif

                @foreach($lists as $list)
                    <div class="col-xl-3 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <a href="{{ route('lists.details', ['id' => $list->id]) }}">
                            <div class="movieCard">
                                <img src="{{$list->poster_image}}"
                                     style="height: 400px; object-fit: cover;"
                                     class="img-fluid" alt="">
                                <h4>{{$list->name}}</h4>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{ $lists->links('components.pagination', ['paginator' => $lists]) }}

@endsection

