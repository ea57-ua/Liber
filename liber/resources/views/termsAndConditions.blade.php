@extends('layouts.master')
@section('title', 'Liber - Terms and Conditions')
@section('content')

    <section id="about" class="about">
        <div class="container" data-aos="fade-up">

            <div class="section-header">
                <div class="section-header">
                    <h2>Terms and Conditions</h2>
                    <p>Welcome to Liber, a social network for movie enthusiasts. These are the terms and conditions for using our service.</p>
                </div>
            </div>

            <div class="row gy-4">
                <div class="col-lg-6">
                    <h3>Acceptance of Terms</h3>
                    <img src="{{ asset('images/terms/terms1.jpg') }}" class="img-fluid rounded-4 mb-4" alt="">
                    <p>By using our service, you agree to these terms and conditions. It's important to understand that adherence to these terms is not optional - it's essential for the smooth functioning of our community.</p>
                    <p>Please read them carefully before using the service. Respect for other users, authors, works, actors, and directors is a cornerstone of these terms. We believe in fostering a community where everyone feels valued and respected.</p>
                    <p>Remember, the administration has the right to remove your posts if they disrespect individuals or works. We're all here to share our love for cinema, so let's keep our discussions and interactions respectful and positive.</p>
                </div>
                <div class="col-lg-6">
                    <div class="content ps-0 ps-lg-5">
                        <p class="fst-italic">
                            If you do not agree to these terms and conditions, please do not use the service.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> You are responsible for any activity that occurs under your account.</li>
                            <li><i class="bi bi-check-circle-fill"></i> You must not abuse, harass, threaten, or intimidate other users.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Any form of discrimination, including but not limited to racism, homophobia, and transphobia, is strictly prohibited.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Respect for all users, regardless of their race, religion, nationality, gender, age, or sexual orientation, is mandatory.</li>
                            <li><i class="bi bi-check-circle-fill"></i> You must not post content that is defamatory, offensive, or illegal.</li>
                            <li><i class="bi bi-check-circle-fill"></i> You must not infringe on the rights of others, including copyright and intellectual property rights.</li>
                            <li><i class="bi bi-check-circle-fill"></i> We reserve the right to send you emails related to the service, such as notifications, announcements, and promotional content.</li>
                            <li><i class="bi bi-check-circle-fill"></i> We reserve the right to remove any content that violates these terms and conditions.</li>
                            <li><i class="bi bi-check-circle-fill"></i> We aim to foster a positive and respectful community for all movie enthusiasts. Any behavior that threatens this goal may result in the suspension or termination of your account.</li>
                        </ul>
                        <p>
                            We reserve the right to modify or terminate the service for any reason, without notice at any time.
                        </p>

                        <div class="position-relative mt-4">
                            <img src="{{ asset('images/terms/terms2.jpg') }}" class="img-fluid rounded-4" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection


