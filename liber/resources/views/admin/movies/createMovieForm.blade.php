@extends('layouts.admin')
@section('content')
    <div class="container">
        <h1 class="display-3">Create movie</h1>

        <div class="row">
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
                    <label for="input-director">Director</label>
                    @if ($errors->has('director'))
                        @foreach($errors->get('director') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-director" name="director" type="text" class="form-control"
                           placeholder="Director of the movie" required
                           value="{{ old('director') }}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-year">Year</label>
                    @if ($errors->has('year'))
                        @foreach($errors->get('year') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-year" name="year" type="number" class="form-control"
                           placeholder="Release year" required
                           value="{{old('year')}}">
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
                    <label for="input-genre">Genres</label>
                    @if ($errors->has('genre'))
                        @foreach($errors->get('genre') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-genre" name="genre" type="text" class="form-control"
                           placeholder="Genre of the movie" required
                           value="{{ old('genre') }}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-duration">Duration</label>
                    @if ($errors->has('duration'))
                        @foreach($errors->get('duration') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-duration" name="duration" type="number" class="form-control"
                           placeholder="Duration of the movie" required
                           value="{{old('duration')}}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-country">Country</label>
                    @if ($errors->has('country'))
                        @foreach($errors->get('country') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-country" name="country" type="text" class="form-control"
                           placeholder="Country" required
                           value="{{ old('country') }}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-rating">Rating</label>
                    @if ($errors->has('rating'))
                        @foreach($errors->get('rating') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-rating" name="rating" type="number" class="form-control"
                           placeholder="Rating" required
                           value="{{ old('rating') }}">
                    <br>
                </div>

                <div>
                    <label for="input-image">Image</label>
                    @if ($errors->has('image'))
                        @foreach($errors->get('image') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input type="file" class="form-control-file"
                           id="input-image" name="image"
                           accept="image/png, image/jpeg, image/jpg">
                    <br>
                    <br>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('admin.movies')}}" class="btn btn-danger">Cancel</a>
            </form>
        </div>
    </div>
@endsection
