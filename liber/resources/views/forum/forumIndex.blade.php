@extends('layouts.master')
@section('title', 'Liber - Forum')
@section('content')
    <style>
        button.toastui-editor-toolbar-icons[aria-label="Insert image"] {
            display: none;
        }
    </style>
    <br>
    <br>
    <br>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-10">
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
                            <div id="imageGallery" class="image-gallery d-flex flex-wrap">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-auto mt-3">
                            @auth()
                            <label for="imageUpload" class="btn-auth">
                                <i class="bi bi-upload" style="font-size: 24px;"></i>
                            </label>
                            <input type="file" id="imageUpload" name="images[]" class="form-control"
                                   multiple accept="image/*" style="display: none;">
                            @endauth
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

        <section id="testimonials" class="testimonials">
            <div class="container" data-aos="fade-up">
                @foreach($posts as $post)
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-10">
                            <div class="testimonial-wrap">
                                <div class="testimonial-item">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $post->user->image}}"
                                                     class="testimonial-img flex-shrink-0" alt="">
                                                <div>
                                                    <h3>{{$post->user->name}}</h3>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="dropdown">
                                            <button class="btn"
                                                    type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="border: none;">
                                                <i class="bi bi-three-dots" style="font-size: 28px;"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(Auth::user()->id == $post->user->id)
                                                <li><a class="dropdown-item navbarDropDownButton forum-post-options" href="#">Edit</a></li>
                                                <li>
                                                    <button type="button" class="btn navbarDropDownButton forum-post-options" data-bs-toggle="modal"
                                                            data-bs-target="#deletePostModal" data-post-id="{{ $post->id }}">
                                                        Delete
                                                    </button>
                                                </li>
                                                @endif
                                                    <li><a class="dropdown-item navbarDropDownButton forum-post-options" href="#">Report</a></li>
                                            </ul>
                                        </div>
                                    </div>

                                    <span class="forum-post-text">
                                        {!! \Illuminate\Support\Str::markdown($post->text) !!}
                                    </span>

                                    @php
                                        $images = [];
                                        for ($i = 1; $i <= 4; $i++) {
                                            if ($post->{'image'.$i}) {
                                                $images[] = $post->{'image'.$i};
                                            }
                                        }
                                        $imageCount = count($images);
                                        $colClass = 'col-12';
                                        if ($imageCount != 1) {
                                            $colClass = 'col-6 flex-grow-1';
                                        }
                                    @endphp
                                    <div class="row">
                                        @foreach($images as $index => $image)
                                            <div class="{{ $colClass }} {{ $index >= 2 ? 'mt-3' : '' }}">
                                                <a href="{{ $image }}"
                                                   class="glightbox rounded"
                                                   data-gallery="postImages{{$post->id}}">
                                                    <img id="movie-poster" src="{{ $image }}"
                                                         class="post-image" alt="Post image">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="mt-2 d-flex align-items-center ">
                                        @if ($post->likes->count() > 0)
                                            <span class="likes-count" data-post-id="{{ $post->id }}">
                                                {{ $post->likes->count() > 0 ? $post->likes->count() : '' }}
                                            </span>
                                        @endif
                                        @if (Auth::user() && $post->likes->contains(Auth::user()->id))
                                            <i class="bi bi-heart-fill like-button post-like-button liked"
                                               data-post-id="{{ $post->id }}"
                                               title="Unlike post"></i>
                                        @else
                                            <i class="bi bi-heart like-button post-like-button"
                                               data-post-id="{{ $post->id }}"
                                               title="Like post"></i>
                                        @endif
                                    </div>
                                    <hr> <!-- Línea de separación -->

                                    @foreach($post->replies as $reply)
                                        <div class="row align-items-start">
                                            <div class="col-auto">
                                                <img src="{{ $reply->user->image }}"
                                                     class="testimonial-img flex-shrink-0 reply-user-image"
                                                     alt="">
                                            </div>
                                            <div class="col" style="margin-left: -25px;">
                                                <h3 style="margin-bottom: -5px">{{$reply->user->name}}</h3>
                                                <span class="forum-post text-muted reply-text">
                                                    {!! \Illuminate\Support\Str::markdown($reply->text) !!}
                                                </span>
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Formulario de respuesta -->
                                    @auth
                                        <form method="POST" action="{{ route('forum.replyPost', $post->id) }}"
                                              class="mt-3">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="reply" class="form-control reply-input"
                                                           placeholder="Add a reply...">
                                                </div>
                                                <div class="col-12 col-md-3 mt-2 mt-md-0">
                                                    <button type="submit" class="btn-auth reply-btn w-100">
                                                        Reply
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    <!-- Advanced editor modal -->
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

    <!-- Delete post modal -->
    <div class="modal fade"
         id="deletePostModal" tabindex="-1" role="dialog"
         aria-labelledby="deletePostModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="deletePostModalLabel">Delete Post</h3>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                </div>
                <div class="modal-body" style="font-size: 20px;">
                    Are you sure you want to delete this post?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form id="deletePostForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://unpkg.com/tributejs/dist/tribute.min.js"></script>
@push('scripts')
    <script>
        var selectedImages = [];

        const lightbox = GLightbox({
            maxZoom: 1,  // Limit zoom to 100%
        });

        function updateFileInput() {
            var imageUpload = document.getElementById('imageUpload');
            var newFileList = new DataTransfer();

            for (var i = 0; i < selectedImages.length; i++) {
                newFileList.items.add(selectedImages[i]);
            }

            imageUpload.files = newFileList.files;
        }

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
                        if (this.files[i].size > 2048 * 1024) {
                            errorLabel.textContent = 'The file "' + this.files[i].name + '" exceeds the upload limit (2MB).';
                            errorLabel.style.display = 'block';
                            continue;
                        }
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
                    updateFileInput();
                    // Remove the image card from the gallery
                    event.target.parentElement.parentElement.remove();
                }
            });

            var deletePostModal = document.getElementById('deletePostModal');
            deletePostModal.addEventListener('show.bs.modal', function (event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var postId = button.getAttribute('data-post-id'); // Extract info from data-* attributes

                var deletePostForm = deletePostModal.querySelector('#deletePostForm');
                deletePostForm.setAttribute('action', '/forum/' + postId + '/delete');
            });

            var likeButtons = document.querySelectorAll('.like-button');
            likeButtons.forEach(function (button) {
                button.addEventListener('click', function () {
                    var postId = this.getAttribute('data-post-id');
                    fetch('/forum/' + postId + '/like', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.liked) {
                                this.classList.remove('bi-heart');
                                this.classList.add('bi-heart-fill', 'liked');
                            } else {
                                this.classList.remove('bi-heart-fill', 'liked');
                                this.classList.add('bi-heart');
                            }

                            var likesCountElement = document.querySelector('.likes-count[data-post-id="' + postId + '"]');
                            if (likesCountElement) {
                                var currentLikesCount = parseInt(likesCountElement.textContent) || 0;
                                if (data.liked) {
                                    likesCountElement.textContent = currentLikesCount + 1;
                                } else {
                                    likesCountElement.textContent = currentLikesCount > 1 ? currentLikesCount - 1 : '';
                                }
                            }
                        });
                });
            });

            var tribute = new Tribute({
                trigger: '@',
                values: function (text, cb) {
                    fetch('/forum/users?search=' + text, {
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                        .then(response => response.json())
                        .then(data => cb(data))
                        .catch(error => console.error(error));
                },
                menuItemTemplate: function (item) {
                    return '<img class="tribute-list-img" src="'+item.original.image + '">' + item.original.name;
                },
                selectTemplate: function (item) {
                    return '@' + item.original.name;
                },
                lookup: 'name',
                fillAttr: 'name'
            });

            tribute.attach(document.getElementById('postInput'));
        });
    </script>
@endpush
