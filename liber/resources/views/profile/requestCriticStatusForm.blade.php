<div class="row">

    @if(Auth::check() && auth()->user()->critic == true)
        <div class="container mt-3">
            <table class="table table-striped table-responsive table-ratings">
                <thead class="thead-dark">
                <tr>
                    <th scope="col" class="font-weight-bold text-center">Movie Name</th>
                    <th scope="col" class="font-weight-bold text-center">Your Rating</th>
                    <th scope="col" class="font-weight-bold text-center">Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($ratings as $rating)
                    <tr>
                        <td class="text-center">
                            <a href="{{ route('movies.details', $rating->movie->id) }}">
                                {{ $rating->movie->title }}
                            </a>
                        </td>                        <td class="text-center">{{ $rating->rating }}</td>
                        <td class="text-center">{{ $rating->created_at->format('d-m-Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    @else
    <div class="col-md-2"></div>
    <div class="col-md-8">
        @if($criticRequest != null && $criticRequest->state == 'rejected')
            <div class="alert alert-danger text-center"
                 style="font-size: 1.5em;">
                <p>Your request for critic status has been
                    <strong style="font-weight: bold;">rejected</strong>.
                    You can apply again.</p>
            </div>
        @endif
        @if($criticRequest == null || $criticRequest->state == 'rejected')

            <h1 class="text-center display-6"> Request Critic Status </h1>
            <p class="text-center">Welcome to the critic status request page. If you are a <strong class="text-primary-strong">movie critic</strong>,
                <strong class="text-primary-strong">influencer</strong>, or your job is related to the <strong class="text-primary-strong">cinema world</strong>,
                you can apply for critic status here.</p>
            <p class="text-center">Please provide a detailed justification for why you should be granted critic status.
                Remember to include any <strong class="text-primary-strong">proof</strong> or <strong class="text-primary-strong">evidence</strong> that you are indeed associated
                with the <strong class="text-primary-strong">cinema world</strong>.</p>

            <form action="{{ route('profile.requestCriticStatus') }}" method="POST"
                  enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="title" style="font-size: 1.2em;">Title <span class="text-danger">*</span></label>
                    <input type="text" id="title" name="title" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="description" style="font-size: 1.2em;">Description <span class="text-danger">*</span></label>
                    <textarea id="description" name="description" rows="5" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="file" style="font-size: 1.2em;margin-right: 4px;">File</label>
                    <i class="bi bi-info-circle" data-bs-toggle="tooltip"
                       data-bs-placement="right" title="Only PDF files are accepted. Maximum file size is 2MB."></i>
                    <input type="file" id="file" name="file" class="form-control" accept="application/pdf">
                    <label id="file_error" class="alert alert-danger mt-2"
                           style="display: none;">File must be less than 2MB</label>
                </div>
                <div class="d-flex justify-content-center mt-3">
                    <button id="criticRequestSubmit" type="submit" class="btn-auth">Request Critic Status</button>
                </div>
            </form>
        @endif
        @if($criticRequest != null && $criticRequest->state == 'pending')
            <div class="alert alert-info text-center"
                 style="font-size: 1.5em;">
                <p>Your request for critic status is
                    <strong style="font-weight: bold;">pending</strong>.
                    You will be notified when a decision is made.</p>
            </div>
        @endif
    </div>
    <div class="col-md-2"></div>
    @endif
</div>

@push('scripts')
    <script>
        var file = document.getElementById('file');
        if (file) {
            file.addEventListener('change', function(e) {
                var fileSize = e.target.files[0].size;
                var maxSize = 2 * 1024 * 1024; // 2MB
                var submitButton = document.getElementById('criticRequestSubmit')

                if (fileSize > maxSize) {
                    e.preventDefault();
                    document.getElementById('file_error').style.display = 'block';
                    submitButton.disabled = true;
                } else {
                    document.getElementById('file_error').style.display = 'none';
                    submitButton.disabled = false;
                }
            });
        }

    </script>
@endpush
