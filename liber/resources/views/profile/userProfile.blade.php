@extends('layouts.master')
@section('title', 'Liber - User Profile')
@section('content')

<div class="container profile-container">
    <div class="row">
        @if (session('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-warning">
                    {{$error}}
                </div>
            @endforeach
        @endif
        @if (session('info'))
            <div class="alert alert-info">
                {{ session('info') }}
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col-12 col-md-3 justify-content-center">
            <img class="profileImage" src="{{$user->image}}" alt="User profile image">
        </div>

        <div class="col-12 col-md-9 container-margin-mobile">
            <div class="row vertical-align">
                <div class="col-12 user-info">
                    <h4 id="user-email" class="user-text text-secondary"><i>{{strtoupper($user->name)}}</i></h4>
                    @if($user->admin)
                        <div class="tooltip-container">
                            <i class="bi bi-person-gear"></i>
                            <span class="tooltip-text">Admin user</span>
                        </div>
                    @endif
                    @if($user->critic)
                        <div class="tooltip-container">
                            <i class="bi bi-person-check"></i>
                            <span class="tooltip-text">Critic user</span>
                        </div>
                    @endif
                </div>
                <div class="col-12">
                    <div class="user-stats">
                        <span class="user-stat"><h4><strong>120</strong> Followers</h4></span>
                        <span class="user-stat"><h4><strong>50</strong> Following</h4></span>
                        <span class="user-stat"><h4><strong>452</strong> Movies Watched</h4></span>
                        <span class="user-stat"><h4><strong>12</strong> Lists</h4></span>
                    </div>
                </div>
                <div class="col-12">
                    <h4 class="biography"> {{$user->biography}}</h4>
                </div>
                @if(auth()->check() && auth()->user()->email == $user->email)
                    <div class="row justify-content-end" style="margin-top: 20px">
                        <div class="col-auto">
                            <button type="button" class="btn-auth" data-bs-toggle="modal" data-bs-target="#popupChooseImage">
                                <i class="bi bi-pencil"></i> Edit Data
                            </button>
                        </div>
                    </div>

                    <div class="modal fade" id="popupChooseImage" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg bg-light">
                            <div class="modal-content bg-light">
                                <div class="modal-header bg-light">
                                    <h4 class="modal-title bg-light" id="exampleModalLabel">Edit user information</h4>
                                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <ul class="nav nav-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#uploadImage">Upload Image</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#editData">Edit Data</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword">Change Password</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="uploadImage">
                                            <form id="image-form" action="{{ route('user.uploadImage', $user->id) }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-body bg-light">
                                                    <label for="image-input" class="custom-file-upload">
                                                        Upload Image
                                                        <input id="image-input" type="file" name="image"
                                                               class="form-control-file bg-light"
                                                               accept="image/png, image/jpeg, image/jpg">
                                                    </label>
                                                    <img id="preview-image" src="#"
                                                         alt="Preview Image"
                                                         style="display: none;"
                                                        class="profileImage">
                                                </div>
                                                <div class="modal-footer">
                                                    <input type="submit" value="Confirm" class="btn-auth">
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="editData">
                                            <form action="{{ route('profile.update', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="name" class="form-input-label">Name</label>
                                                    <input type="text" id="name" name="name" value="{{ $user->name }}" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="biography" class="form-input-label">Biography</label>
                                                    <textarea id="biography" name="biography" class="form-control" rows="4">{{ $user->biography }}</textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email" class="form-input-label">Email</label>
                                                    <input type="email" id="email" name="email" value="{{ $user->email }}" class="form-control">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn-auth">Update</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="tab-pane fade" id="changePassword">
                                            <form action="{{ route('profile.changePassword', $user->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="current_password" class="form-input-label">Current Password</label>
                                                    <input type="password" id="current_password" required
                                                           name="current_password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_password" class="form-input-label">New Password</label>
                                                    <input type="password" id="new_password" required
                                                           name="new_password" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label for="new_password_confirmation" class="form-input-label">Confirm New Password</label>
                                                    <input type="password" id="new_password_confirmation" required
                                                           name="new_password_confirmation" class="form-control">
                                                    <label id="password_error" class="alert alert-warning" style="display: none;">Passwords do not match</label>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn-auth">Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

        </div>
    </div>

    <div class="row">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#watchedMovies">Movies</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#userListsList">Lists</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#userReviewsList">Reviews</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-bs-toggle="tab" href="#userFollowersList">Followers</a>
            </li>
            @if(auth()->check() && auth()->user()->email == $user->email)
                <li class="nav-item">
                    <a class="nav-link" data-bs-toggle="tab" href="#criticStatusZone">Critics</a>
                </li>
            @endif
        </ul>

        <div class="tab-content">

            <div class="tab-pane container" id="criticStatusZone">
                <div class="row">
                    @include('profile.requestCriticStatusForm')
                </div>
            </div>

            <div class="tab-pane container" id="watchedMovies">
                <div class="row">
                    @include('profile.watchedMoviesList')
                </div>
            </div>

            <div class="tab-pane container" id="userListsList">
                <div class="row">
                    @include('profile.userListsListComponent')
                </div>
            </div>

            <div class="tab-pane container" id="userReviewsList">
                <div class="row">
                    <h1> reviews </h1>
                </div>
            </div>

            <div class="tab-pane container" id="userFollowersList">
                <div class="row">
                    @include('profile.userFollowersList')
                </div>
            </div>


        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.getElementById('image-input').addEventListener('change', function(e) {
        var reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('preview-image').src = event.target.result;
            document.getElementById('preview-image').style.display = 'block';
        }

        reader.readAsDataURL(e.target.files[0]);
    });

    document.getElementById('changePassword').addEventListener('submit', function(e) {
        var newPassword = document.getElementById('new_password').value;
        var newPasswordConfirmation = document.getElementById('new_password_confirmation').value;

        if (newPassword !== newPasswordConfirmation) {
            e.preventDefault();
            document.getElementById('password_error').style.display = 'block';
        } else if (newPassword.length < 8) {
            e.preventDefault();
            document.getElementById('password_error').style.display = 'block';
            document.getElementById('password_error').textContent = 'Password must be at least 8 characters long';
        } else {
            document.getElementById('password_error').style.display = 'none';
        }
    });
</script>
@endpush
