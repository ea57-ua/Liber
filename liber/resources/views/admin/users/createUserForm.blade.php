@extends('layouts.admin')
@section('title', 'LiberAdmin - User Form')
@section('content')
    <div class="container">
        <h1 class="display-3">Create user</h1>
        <div class="row" >
            <form  action="{{route('admin.users.create.save')}}" method="POST" enctype="multipart/form-data">
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
                           value="{{ old('name') }}">
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
                           value="{{ old('surname') }}">
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
                           placeholder="Enter email" required value="{{old('email')}}">
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
                           value="{{ old('biography') }}">
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
                        required value="{{old('password')}}">
                    <br>
                </div>

                <div class="form-group">
                    <label for="input-image">Profile image</label>
                    <br>
                    <input type="file" class="form-control-file" id="input-image" name="image"
                           accept="image/png, image/jpeg, image/jpg">
                    <br>
                    <br>
                </div>

                <div class="form-check">
                    @if ($errors->has('admin'))
                        @foreach($errors->get('admin') as $error)
                            <p class="alert alert-danger"> {{ $error }}</p>
                        @endforeach
                    @endif
                    <input type="checkbox" class="form-check-input" id="input-admin" name="admin"
                           value="1" {{ old('admin') == '1' ? 'checked' : '' }}>
                    <label class="form-check-label" for="input-admin">Admin privileges</label>
                    <br>
                </div>
                <br>
                <button type="submit" class="btn btn-primary">Create</button>
                <a href="{{route('admin.users')}}" class="btn btn-danger">Cancel</a>
            </form>

        </div>
    </div>
@endsection

