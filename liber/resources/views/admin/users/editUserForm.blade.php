@extends('layouts.admin')
@section('title', 'LiberAdmin - User Edit')
@section('content')
    <div class="container">
        <h1 class="display-3">Edit user</h1>
        <div class="row" >
            <form  action="{{route('admin.users.edit.save', ['id' => $user->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="input-name">Name</label>
                    @if ($errors->has('name'))
                        @foreach($errors->get('name') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-name" name="name" type="text" class="form-control"
                           placeholder="Name of the user" required
                           value="{{ old('name', $user->name) }}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-surname">Surname</label>
                    @if ($errors->has('surname'))
                        @foreach($errors->get('surname') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-surname" name="surname" type="text" class="form-control"
                           placeholder="Surname of the user" required
                           value="{{ old('surname', $user->surname) }}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-email">Email address</label>
                    @if ($errors->has('email'))
                        @foreach($errors->get('email') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input type="email" class="form-control" id="input-email" name="email" aria-describedby="emailHelp"
                           placeholder="Enter email" required value="{{old('email', $user->email)}}">
                    <small id="emailHelp" class="form-text text-muted">Example: alexander@gmail.com</small>
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-biography">Biography</label>
                    @if ($errors->has('biography'))
                        @foreach($errors->get('biography') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input id="input-biography" name="biography" type="text" class="form-control"
                           placeholder="Information about the user"
                           value="{{ old('biography', $user->biography) }}">
                    <br>
                </div>


                <div class="form-group">
                    <label for="input-password">Password</label>
                    @if ($errors->has('password'))
                        @foreach($errors->get('password') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input type="password" class="form-control" id="input-password"
                           placeholder="Password" name="password"
                           required value="{{old('password', $user->password)}}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-image">Profile image:</label>
                    @if ($user->image)
                        <img src="{{asset($user->image) }}" alt="Actual profile image" class="img-thumbnail"
                             style="max-width: 200px; max-height: 200px;">
                    @else
                        <p> No image associated with the user.</p>
                    @endif
                    <br>
                    <label for="input-new-image">New profile image</label>
                    <input type="file" class="form-control-file" id="input-image" name="image"
                           accept="image/png, image/jpeg, image/jpg">
                    <br>
                    <br>
                </div>

                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="admin" name="admin"
                           value="1" {{ old('admin', $user->admin) == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="input-admin">Admin privileges</label>
                    <br>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Edit</button>
                <a href="{{route('admin.users')}}" class="btn btn-danger">Cancel</a>
            </form>

        </div>
    </div>
@endsection
