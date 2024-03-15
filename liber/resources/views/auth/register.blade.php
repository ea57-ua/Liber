@extends('layouts.master')
@section('title', 'Liber - Login form')
@section('content')
    <section id="stats-counter" class="stats-counter">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6">
                    <div class="container">
                        <div class="d-flex justify-content-center mt-4">
                            <a href="{{ route('login.google') }}" class="text-decoration-none text-secondary">
                                Login With Google
                            </a>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Name') }}</label>
                                <input id="name" class="form-control" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                                @error('name')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autocomplete="username" />
                                @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Password') }}</label>
                                <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                                @error('password')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{ __('Confirm Password') }}</label>
                                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                                @error('password_confirmation')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-center align-items-center mt-4">
                                <a class="text-decoration-none text-secondary me-3"
                                   href="{{ route('login') }}"
                                    style="font-size: 15px">
                                    {{ __('Already registered?') }}
                                </a>

                                <button type="submit" class="btn-auth">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

                <div class="col-lg-6">
                    <img src="{{ asset('img/registerImage.jpg') }}"
                         alt="" class="img-fluid"
                         style="border-radius: 5%">
                </div>
            </div>
        </div>
    </section>
@endsection


