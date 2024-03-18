<div class="row">
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <h1 class="text-center display-6"> Request Critic Status </h1>
        <p class="text-center">Welcome to the critic status request page. If you are a <strong>movie critic</strong>,
            <strong>influencer</strong>, or your job is related to the <strong>cinema world</strong>,
            you can apply for critic status here.</p>
        <p class="text-center">Please provide a detailed justification for why you should be granted critic status.
            Remember to include any <strong>proof</strong> or <strong>evidence</strong> that you are indeed associated
            with the <strong>cinema world</strong>.</p>

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
                <label for="file" style="font-size: 1.2em;margin-right: 8px;">File</label>
                <i class="bi bi-info-circle" data-bs-toggle="tooltip"
                   data-bs-placement="right" title="Only PDF files are accepted. Maximum file size is 2MB."></i>
                <input type="file" id="file" name="file" class="form-control" accept="application/pdf">

            </div>
            <div class="d-flex justify-content-center mt-2 mb-auto">
                <button type="submit" class="btn-auth">Request Critic Status</button>
            </div>
        </form>
    </div>
    <div class="col-md-2"></div>
</div>

@push('scripts')
    <script>
        // Inicializa los tooltips de Bootstrap
        $(function () {
            $('[data-bs-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
