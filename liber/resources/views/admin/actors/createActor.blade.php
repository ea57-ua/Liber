@extends('layouts.admin')
@section('content')

    <div class="pagetitle">
        <h1>Add actor</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.actors')}}">actors</a></li>
                <li class="breadcrumb-item active">Add actor</li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Add Actor Form</h5>
                <div class="profile-edit pt-3">
                    <form action="{{route('admin.actors.create.save')}}" method="POST">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label for="input-title">Name</label>
                            @if ($errors->has('name'))
                                @foreach($errors->get('name') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <input id="input-description" name="name" type="text" class="form-control"
                                   placeholder="actor's name" required
                                   value="{{ old('name') }}">
                            <br>
                        </div>

                        <div class="form-group">
                            <label for="input-synopsis">Description</label>
                            @if ($errors->has('description'))
                                @foreach($errors->get('description') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <textarea id="input-description" name="description" type="text" class="form-control"
                                      placeholder="Description of the actor" rows="10" required
                            >{{ old('description') }} </textarea>
                        </div>



                        <div class="form-group mt-2">
                            <label for="posterURL">Photo URL</label>
                            @if ($errors->has('photoURL'))
                                @foreach($errors->get('photoURL') as $error)
                                    <p class="alert alert-danger"> {{ $error }}</p>
                                @endforeach
                            @endif
                            <input id="photoURL" name="photoURL" type="text" class="form-control"
                                   placeholder="actor's photo's URL" required
                                   value="{{ old('photoURL') }}">
                            <br>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-4 me-3">Create</button>
                            <a href="{{route('admin.actors')}}" class="btn btn-danger mt-4">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>



@endsection