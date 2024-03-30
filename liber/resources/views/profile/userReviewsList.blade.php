@if(count($reviews) == 0)
    <div class="alert alert-info" role="alert">
        <h4>No reviews redacted yet.</h4>
    </div>
    <div class="col-md-12 d-flex justify-content-center ">

        <a href="{{ route('moviesPage') }}"
           class="btn btn-auth alert-link">
            Browse movies to start
        </a>
    </div>
@endif

<section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
        @foreach($reviews as $review)
            <div class="row">
                <div class="col-12">
                    <div class="testimonial-wrap">
                        <div class="testimonial-item">
                            <div class="d-flex align-items-center">
                                <div>
                                    <h3>{{$review->movie->title}}</h3>
                                    <div class="stars">
                                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                    </div>
                                </div>
                            </div>
                            <p style="word-wrap: break-word;">
                                <i class="bi bi-quote quote-icon-left"></i>
                                {{ $review->text }}
                                <i class="bi bi-quote quote-icon-right"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</section>

