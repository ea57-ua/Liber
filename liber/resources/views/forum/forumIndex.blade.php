@extends('layouts.master')
@section('title', 'Liber - Forum')
@section('content')
    <style>
        button.toastui-editor-toolbar-icons[aria-label="Insert image"] {
            display: none;
        }
    </style>
    <h1>Forum page</h1>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="postError" class="alert alert-danger"
                     style="display: none;">
                </div>
                <form method="POST" id="postForm" action="{{route('forum.newPost')}}"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <div class="form-group">
                            <label for="postInput" id="postInputLabel" class="post-placeholder">
                                What do you have in mind?
                            </label>
                            <div id="postInput" class="form-control forum-post-input"
                                 contenteditable="true">
                            </div>
                            <input type="hidden" name="text" id="hiddenPostInput">
                            <div id="imageGallery" class="image-gallery d-flex flex-wrap mt-2"></div>

                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-auto mt-3">
                            <label for="imageUpload" class="btn-auth">
                                <i class="bi bi-upload" style="font-size: 24px;"></i>
                            </label>
                            <input type="file" id="imageUpload" name="images[]" class="form-control"
                                   multiple accept="image/*" style="display: none;">
                        </div>

                        @auth()
                        <div id="advancedEditorOption" class="col-auto mt-3" style="display: none;">
                            <button type="button" class="btn-auth forum-post-btn"
                                    data-bs-toggle="modal" data-bs-target="#advancedEditorModal">
                                Advanced editor
                            </button>
                        </div>
                        @endauth
                        <input type="hidden" name="markdownContent" id="markdownContent">
                        <div class="col-auto form-group text-right">
                            @auth()
                                <button type="submit" id="postSubmitButton"
                                        class="btn-auth forum-post-btn mt-3 mb-4">
                                    Post
                                </button>
                            @endauth
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="" style="margin-bottom: 200px">
    @foreach($posts as $post)
        <h1> {{$post->user->name}} : {!! \Illuminate\Support\Str::markdown($post->text) !!}</h1>
    @endforeach
    </div>

    <div class="modal fade" id="advancedEditorModal" tabindex="-1"
         role="dialog" aria-labelledby="advancedEditorModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="advancedEditorModalLabel">Advanced Editor</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="advancedEditor">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="submitPostModal" class="btn-auth">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var selectedImages = [];
        document.addEventListener('DOMContentLoaded', function () {
            document.getElementById('postInput').addEventListener('click', function () {
                document.getElementById('advancedEditorOption').style.display = 'block';
            });

            document.getElementById('postForm').addEventListener('submit', function () {
                var postInput = document.getElementById('postInput');
                var hiddenPostInput = document.getElementById('hiddenPostInput');
                hiddenPostInput.value = postInput.innerHTML;
            });

            document.getElementById('imageUpload').addEventListener('change', function () {
                var errorLabel = document.getElementById('postError');

                var imageGallery = document.getElementById('imageGallery');
                var totalImages = selectedImages.length + this.files.length;

                if (totalImages > 4) {
                    errorLabel.textContent = 'You can only upload 4 images in a post.';
                    errorLabel.style.display = 'block';
                    this.value = '';
                } else {
                    errorLabel.style.display = 'none';

                    for (var i = 0; i < this.files.length; i++) {
                        selectedImages.push(this.files[i]);
                    }
                    imageGallery.innerHTML = '';

                    for (var i = 0; i < selectedImages.length; i++) {
                        // Create a card element
                        var card = document.createElement('div');
                        card.className = 'col-xl-6 col-md-12 col-sm-12';
                        // Create a card wrap element
                        var cardWrap = document.createElement('div');
                        cardWrap.className = 'card-wrap';
                        // Create an image element
                        var img = document.createElement('img');
                        img.src = URL.createObjectURL(selectedImages[i]);
                        img.className = 'img-fluid';
                        img.alt = '';
                        cardWrap.appendChild(img);

                        var closeButton = document.createElement('button');
                        closeButton.className = 'close-button card-close-button';
                        closeButton.dataset.index = i; // Store the index of the image
                        var closeIcon = document.createElement('i');
                        closeIcon.className = 'bi bi-x';
                        closeButton.appendChild(closeIcon);
                        cardWrap.appendChild(closeButton);
                        card.appendChild(cardWrap);
                        imageGallery.appendChild(card);
                    }
                }
            });

            document.getElementById('postInput').addEventListener('click', function () {
                var placeholder = document.getElementById("postInputLabel");
                placeholder.style.display = 'none';
            });

            document.getElementById('imageGallery').addEventListener('click', function (event) {
                console.log("Clicked");
                event.preventDefault();
                var target = event.target;
                // Find the close button
                while (target !== this && !target.classList.contains('close-button')) {
                    target = target.parentElement;
                }
                // If the close button was clicked
                if (target !== this) {
                    console.log("Close button clicked");
                    var index = event.target.dataset.index;
                    // Remove the image from the selectedImages array
                    selectedImages.splice(index, 1);
                    // Remove the image card from the gallery
                    event.target.parentElement.parentElement.remove();
                }
            });
        });


    </script>
@endpush
