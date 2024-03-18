<h1> Followers list </h1>
<div class="row">
    @foreach ($followers as $follower)
        <div class="col-md-6 p-1 follower-card">
            <a href="{{ route('users.publicProfile', $follower->id) }}"
               class="list-group-item list-group-item-action">
                <div class="d-flex align-items-center">
                    <img src="{{ $follower->image }}"
                         class="img-fluid follower-img rounded-circle me-3" alt="Profile Image">
                    <div>
                        <h5 class="mb-0" style="font-size: 1.5em;">{{ $follower->name }}</h5>
                        <span class="badge bg-primary">{{ $follower->pivot->created_at->format('M d, Y') }}</span>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div id="load-more-container">
    @if ($followers->hasMorePages())
        <button id="load-more-button">Load more</button>
    @endif
</div>

@push('scripts')
    <script>
        document.getElementById('load-more-button').addEventListener('click', function() {
            // Aquí va el código para cargar más seguidores
        });
    </script>
@endpush
