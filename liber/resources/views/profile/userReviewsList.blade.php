<section id="testimonials" class="testimonials">
    <div class="container" data-aos="fade-up">
        <div class="row">
            @foreach($reviews as $review)
                <div class="col-12 col-sm-6 col-lg-4 mb-4">
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
            @endforeach
        </div>
    </div>
</section>
