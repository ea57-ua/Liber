<div class="row">
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
