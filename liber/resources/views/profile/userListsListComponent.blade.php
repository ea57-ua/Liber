<div class="row">
    @auth()
        @if(Auth::user()->id == $user->id)
        <div class="d-flex justify-content-end mb-3">
            <button class="btn-auth" data-bs-toggle="modal"
                    data-bs-target="#newListModal">
                New list
            </button>
        </div>
        @endif
    @endauth
    @if(count($lists) == 0)
        <div class="alert alert-info" role="alert">
            <h4>No lists created yet.</h4>
        </div>
        <div class="col-md-12 d-flex justify-content-center ">

            <a href="{{ route('listsPage') }}"
               class="btn btn-auth alert-link">
                Browse users lists to inspire yourself
            </a>
        </div>
    @endif

    @foreach ($lists as $list)
        <div class="col-md-3">
            <a href="{{ route('lists.details', $list->id) }}" class="text-decoration-none">
                <div class="card" style="margin-bottom: 20px;">
                    <img class="card-img-top" src="{{ $list->poster_image }}"
                         alt="Movie poster" style="border-radius: 5px;">
                    <div class="card-body d-flex justify-content-center align-items-center">
                        <h5 class="card-title text-center">{{ $list->name }}</h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>

<div class="modal fade" id="newListModal" tabindex="-1"
     aria-labelledby="newListModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newListModalLabel">New list</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"
                        aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="imageError" class="alert alert-danger" style="display: none;"></div>
                <form action="{{ route('lists.create') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="listName" class="form-label">List Name</label>
                        <input type="text" class="form-control" id="listName" name="listName" required>
                    </div>
                    <div class="mb-3">
                        <label for="listDescription" class="form-label">Description (optional)</label>
                        <textarea class="form-control" id="listDescription" name="listDescription"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="listImage" class="form-label">Cover Image (optional)</label>
                        <input type="file" class="form-control" id="listImage" name="listImage">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <input type="checkbox" id="isPublic" name="isPublic" value="1">
                                <label class="form-check-label" for="isPublic">Public</label>
                            </div>
                        </div>

                        <div class="col">
                            <div class="mb-3">
                                <input type="checkbox" id="isWatchlist" name="isWatchlist" value="1">
                                <label class="form-check-label" for="isWatchlist">Watchlist</label>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn-auth" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn-auth">Save list</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    document.getElementById('listImage').addEventListener('change', function () {
        var file = this.files[0];
        var maxSize = 2 * 1024 * 1024; // 2MB
        var errorDiv = document.getElementById('imageError');

        if(file.size > maxSize) {
            errorDiv.textContent = 'The selected file is too large. Please select a file less than 2MB.';
            errorDiv.style.display = 'block';
            this.value = '';
        }else {
            errorDiv.style.display = 'none';
        }
    });
</script>
