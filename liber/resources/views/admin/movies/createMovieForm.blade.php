@extends('layouts.admin')
@section('title', 'LiberAdmin - Movie Form')
@section('content')

    <div class="pagetitle">
        <h1>Create Movie</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.movies')}}">Movies</a></li>
                <li class="breadcrumb-item active">Create movie</li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Create Movie Form</h5>
                <div class="profile-edit pt-3">
                    <form action="{{route('admin.movies.create.save')}}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="input-title">Title</label>
                            @if ($errors->has('title'))
                                @foreach($errors->get('title') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <input id="input-title" name="title" type="text" class="form-control"
                                   placeholder="Title of the movie" required
                                   value="{{ old('title') }}">
                            <br>
                        </div>

                        <div class="form-group">
                            <label for="input-synopsis">Synopsis</label>
                            @if ($errors->has('synopsis'))
                                @foreach($errors->get('synopsis') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <textarea id="input-synopsis" name="synopsis" type="text" class="form-control"
                                      placeholder="Synopsis of the movie" required
                            >{{ old('synopsis') }} </textarea>
                        </div>

                        <div class="form-group">
                            <label for="input-year">Year</label>
                            @if ($errors->has('year'))
                                @foreach($errors->get('year') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <input id="input-year" name="year" type="date" class="form-control"
                                   placeholder="Release year" required
                                   value="{{old('year')}}">
                            <br>
                        </div>

                        <div class="form-group">
                            <label for="posterURL">Poster URL</label>
                            @if ($errors->has('posterURL'))
                                @foreach($errors->get('posterURL') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <input id="posterURL" name="posterURL" type="text" class="form-control"
                                   placeholder="Movie's poster's URL" required
                                   value="{{ old('posterURL') }}">
                            <br>
                        </div>

                        <div class="form-group">
                            <label for="trailerURL">Trailer URL</label>
                            @if ($errors->has('trailerURL'))
                                @foreach($errors->get('trailerURL') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <input id="trailerURL" name="trailerURL" type="text" class="form-control"
                                   placeholder="Movie's trailer link" required
                                   value="{{ old('trailerURL') }}">
                            <br>
                        </div>

                        <div class="form-group">
                            <label for="backgroundURL">Background image URL</label>
                            @if ($errors->has('backgroundURL'))
                                @foreach($errors->get('backgroundURL') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <input id="backgroundURL" name="backgroundURL" type="text" class="form-control"
                                   placeholder="Movie background image link" required
                                   value="{{ old('backgroundURL') }}">
                            <br>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4 me-3">Create</button>
                            <a href="{{route('admin.movies')}}" class="btn btn-danger mt-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection
