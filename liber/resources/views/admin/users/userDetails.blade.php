@extends('layouts.admin')
@section('content')

    <div class="container mt-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-lg">
                    <div class="card-header">
                        User details
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }} {{ $user->surname }}</h5>
                        <p class="card-text">
                            <strong>Email:</strong> {{ $user->email }}
                        </p>
                        <p class="card-text">
                            <strong>Biography:</strong> {{ $user->biography }}
                        </p>
                        <p class="card-text">
                            <strong>Admin privileges:</strong> {{ $user->admin ? 'Yes' : 'No' }}
                        </p>
                        <p class="card-text">
                            @if($user->image != null)
                            <strong>Profile image:</strong> <img src="{{ $user->image }}" alt="Profile image" class="img-fluid">
                            @endif
                        </p>
                    </div>
                    <div class="card-footer">
                        <a href="{{ route('admin.users') }}" class="btn btn-secondary">Go back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
