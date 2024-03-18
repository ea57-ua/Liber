<div class="row">
    @foreach ($watchedMovies as $movie)
        <div class="col-md-3">
            <a href="{{ route('movies.details', $movie->id) }}" class="text-decoration-none">
                <div class="card" style="margin-bottom: 20px;">
                    <img class="card-img-top" src="{{ $movie->posterURL }}"
                         alt="Movie poster" style="border-radius: 5px;">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h5 class="card-title text-center">{{ $movie->title }}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
