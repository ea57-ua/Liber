<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Favourite Genres</h2>
            @foreach($user->favoriteGenres as $genre)
                <button class="btn btn-genre fs-5"
                        data-bs-toggle="modal"
                        data-bs-target="#confirmModal{{$genre->id}}">
                    {{ $genre->name }}
                    <i class="fas fa-times fa-lg"></i>
                </button>

                <div class="modal fade" id="confirmModal{{$genre->id}}" tabindex="-1"
                     role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="confirmModalLabel">
                                    Confirm Action
                                </h5>
                                <button type="button" class="btn-close"
                                        data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to remove <strong>{{$genre->name}}</strong> from your favorites?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Cancel</button>
                                <form method="POST" action="{{ route('profile.deleteFavGenre') }}">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="genre" value="{{ $genre->id }}">
                                    <button type="submit" class="btn-auth" id="confirmButton{{$genre->id}}">Yes, remove</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-6">
            <div class="input-group genreSearch">
                <input type="text" id="genreSearch" class="form-control" placeholder="Search genres">
                <div class="input-group-append">
                    <button id="searchButton" class="btn btn-outline-secondary form-control">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-6 d-flex flex-wrap" id="searchResults"></div>
    </div>
</div>

@push('scripts')
<script>
    document.getElementById('searchButton').addEventListener('click', function() {
        const searchValue = document.getElementById('genreSearch').value;
        fetch('/searchGenres', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ search: searchValue })
        })
            .then(response => response.json())
            .then(data => {
                const resultsDiv = document.getElementById('searchResults');
                resultsDiv.innerHTML = '';
                data.forEach(genre => {
                    const resultsDiv = document.getElementById('searchResults');
                    resultsDiv.innerHTML = '';
                    data.forEach(genre => {
                        const genreForm = document.createElement('form');
                        genreForm.method = 'POST';
                        genreForm.action = '/updateFavGenres';

                        const csrfInput = document.createElement('input');
                        csrfInput.type = 'hidden';
                        csrfInput.name = '_token';
                        csrfInput.value = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                        genreForm.appendChild(csrfInput);

                        const methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'PUT';
                        genreForm.appendChild(methodInput);

                        const genreInput = document.createElement('input');
                        genreInput.type = 'hidden';
                        genreInput.name = 'genres[]';
                        genreInput.value = genre.id;
                        genreForm.appendChild(genreInput);

                        const genreButton = document.createElement('button');
                        genreButton.type = 'submit';
                        genreButton.classList.add('btn', 'btn-genre', 'me-1', 'mb-2');
                        genreButton.textContent = genre.name;
                        genreButton.innerHTML += ' <i class="bi bi-plus-circle" style="font-size: 16px;"></i>';
                        genreForm.appendChild(genreButton);

                        resultsDiv.appendChild(genreForm);
                    });
                });
            });
    });
</script>
@endpush
