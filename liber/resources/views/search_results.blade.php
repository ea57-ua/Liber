@extends('layouts.master')
@section('title', 'Liber - Search Results')
@section('content')
    <div style="margin-top: 120px;"></div>

    @if($movies->isEmpty() && $users->isEmpty() && $lists->isEmpty())
        <div class="d-flex justify-content-center align-items-center"
            style="margin-bottom: 400px;">
            <div class="alert alert-info text-center"
                 role="alert" style="font-size: 2em;">
                No search results found for "{{ $query }}"
            </div>
        </div>
    @else
        @if($movies->isNotEmpty())
        <div class="container" style="margin-bottom: 50px;">
            <h2 class="text-center" style="font-weight: bold;font-size: 30px">Movies Results</h2>
            <hr style="background-color: #00a995;height: 3px;">
            <div class="row">
                @foreach($movies as $movie)
                    <div class="col-lg-3 col-md-6 mb-4">
                        <a href="{{ route('movies.details', $movie->id) }}">
                            <div class="card">
                                <img class="card-img-top" src="{{ $movie->posterURL }}" alt="{{ $movie->title }} poster">
                                <div class="card-body">
                                    <h5 class="card-title d-flex justify-content-center"
                                        style="font-weight: bold">
                                        {{ $movie->title }}
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        @if($lists->isNotEmpty())
            <div class="container" style="margin-bottom: 50px;">
                <h2 class="text-center" style="font-weight: bold;font-size: 30px">Lists Results</h2>
                <hr style="background-color: #00a995;height: 3px;">
                <div class="row">
                    @foreach($lists as $list)
                        <div class="col-lg-3 col-md-6 mb-4">
                            <a href="{{ route('lists.details', $list->id) }}">
                                <div class="card">
                                    <img class="card-img-top" src="{{ $list->poster_image }}"
                                         alt="{{ $list->name }} image">
                                    <div class="card-body">
                                        <h5 class="card-title d-flex justify-content-center"
                                            style="font-weight: bold">
                                            {{ $list->name }}
                                        </h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        @if($users->isNotEmpty())
            <div class="container">
                <h2 class="text-center">User Results</h2>
                <hr style="background-color: #00a995;height: 3px;">
                <div class="row d-flex justify-content-center align-items-center">
                    @foreach ($users as $user)
                        <div class="col-sm-10 col-md-5 me-2"
                             style="border: 1px solid #00a995;
                                margin-bottom: 10px;border-radius: 20px">
                            <a href="{{ route('users.publicProfile', $user->id) }}"
                               class="list-group-item list-group-item-action">
                                <div class="d-flex align-items-center">
                                    <img src="{{ $user->image }}"
                                         class="img-fluid follower-img rounded-circle me-3"
                                         style="width: 100px; height: 100px;"
                                         alt="Profile Image">
                                    <div>
                                        <h5 class="mb-0" style="font-size: 1.5em;">{{ $user->name }}</h5>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div style="margin-bottom: 300px;"></div>
    @endif
@endsection
