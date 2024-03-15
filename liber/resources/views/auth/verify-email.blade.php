@extends('layouts.master')
@section('title', 'Liber - Verify Email')
@section('content')
    <section id="stats-counter" class="stats-counter">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4 align-items-center">

                <div class="col-lg-6">
                    <div class="container">
                        <h1 class="mb-4 text-center">Verify Email</h1>
                        <p class="fs-3 text-secondary">
                            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="mb-4 fs-3 text-success">
                                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                            </div>
                        @endif

                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf

                                <div>
                                    <button type="submit" class="btn btn-auth">
                                        {{ __('Resend Verification Email') }}
                                    </button>
                                </div>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="btn btn-custom" style="font-size: 16px">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <img src="{{ asset('img/verifyEmailImage.jpg') }}"
                         alt="" class="img-fluid"
                         style="border-radius: 5%">
                </div>
            </div>
        </div>
    </section>




@endsection()

