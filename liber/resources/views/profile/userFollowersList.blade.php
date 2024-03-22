<h1> Followers list </h1>
<div class="row">
    @if(count($followers) == 0)
        <div class="alert alert-info" role="alert">
            <h4>No followers yet.</h4>
        </div>
        <div class="col-md-12 d-flex justify-content-center ">

            <a href="{{ route('forumPage') }}"
               class="btn btn-auth alert-link">
                Interact with other users to get followers
            </a>
        </div>
    @endif

    @foreach ($followers as $follower)
        <div class="col-md-6 p-1">
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

@push('scripts')
    <script>

    </script>
@endpush
