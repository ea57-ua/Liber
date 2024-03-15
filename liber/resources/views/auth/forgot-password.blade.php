@extends('layouts.master')
@section('title', 'Liber - Forgot Password')
@section('content')

    <section id="stats-counter" class="stats-counter">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6">
                    <div class="container">
                        <h1 class="mb-4 text-center">Forgot Password</h1>
                        <p class="fs-3 text-secondary">
                            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                        </p>

                        <!-- Session Status -->
                        @if (session('status'))
                            <div class="alert alert-info mb-4">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Email') }}</label>
                                <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus />
                                @error('email')
                                <div class="alert alert-danger mt-2">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="d-flex justify-content-end justify-content-center mt-4">
                                <button type="submit" class="btn btn-auth">
                                    {{ __('Email Password Reset Link') }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="{{asset('img/tarantinoArt.jpg')}}"
                         alt="" class="img-fluid"
                         style="border-radius: 5%">
                </div>
            </div>
        </div>
    </section>




@endsection()

