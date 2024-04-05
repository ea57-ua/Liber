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
                                <label for="imageUpload" class="btn-auth"
                                       style="padding: 10px 15px;border-radius: 15px">
                                    <i class="bi bi-upload" style="font-size: 34px;"></i>
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
                                <div class="testimonial-item forum-post-container" data-post-id="{{ $post->id }}">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <a href="{{route('users.publicProfile', $post->user->id)}}">
                                                <div class="d-flex align-items-center clickable-item">
                                                    <img src="{{ $post->user->image}}"
                                                         class="testimonial-img flex-shrink-0" alt="">
                                                    <div>
                                                        <h3>{{$post->user->name}}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>

                                        <div class="dropdown clickable-item">
                                            <button class="btn clickable-item"
                                                    type="button" id="dropdownMenuButton"
                                                    data-bs-toggle="dropdown" aria-expanded="false"
                                                    style="border: none;">
                                                <i class="bi bi-three-dots clickable-item" style="font-size: 28px;"></i>
                                            </button>
                                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                @if(Auth::check() && Auth::user()->id == $post->user->id)
                                                    <li>
                                                        <a class="dropdown-item navbarDropDownButton forum-post-options clickable-item"
                                                           href="#">Edit</a></li>
                                                    <li>
                                                        <button type="button"
                                                                class="btn navbarDropDownButton forum-post-options clickable-item"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#deletePostModal"
                                                                data-post-id="{{ $post->id }}">
                                                            Delete
                                                        </button>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item navbarDropDownButton forum-post-options clickable-item"
                                                           href="#">Report</a></li>
                                                @endif
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
                                            <div class="{{ $colClass }} {{ $index >= 2 ? 'mt-3' : '' }} clickable-item">
                                                <a href="{{ $image }}"
                                                   class="glightbox rounded"
                                                   data-gallery="postImages{{$post->id}}">
                                                    <img id="movie-poster" src="{{ $image }}"
                                                         class="post-image" alt="Post image">
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Likes y comentarios -->
                                    <div class="mt-2 d-flex align-items-center justify-content-center">
                                        <div class="col text-center">
                                            @if ($post->likes->count() > 0)
                                                <span class="likes-count" data-post-id="{{ $post->id }}">
                                                    {{ $post->likes->count() > 0 ? $post->likes->count() : '' }}
                                                </span>
                                            @endif
                                            @if (Auth::user() && $post->likes->contains(Auth::user()->id))
                                                <i class="bi bi-heart-fill like-button post-like-button liked clickable-item"
                                                   data-post-id="{{ $post->id }}"
                                                   title="Unlike post"></i>
                                            @else
                                                <i class="bi bi-heart like-button post-like-button clickable-item"
                                                   data-post-id="{{ $post->id }}"
                                                   title="Like post"></i>
                                            @endif
                                        </div>
                                        <div class="col text-center">
                                            @if($post->replies_count == 0)
                                                <div class="replies-count">
                                                    <i class="bi bi-chat" style="color: black"></i>
                                                </div>
                                            @endif
                                            @if($post->replies_count > 0)
                                                <div class="replies-count">
                                                    <span class="replies-count">
                                                        {{ $post->replies_count }}
                                                    </span>
                                                    <i class="bi bi-chat-fill" title="Replies number"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="col text-center">
                                            <!-- Espacio reservado para futuros elementos -->
                                        </div>
                                    </div>
                                    <hr> <!-- Línea de separación -->

                                    @foreach($post->replies as $reply)
                                        <div class="row align-items-start">
                                            <div class="col-auto">
                                                <a href="{{route('users.publicProfile', $reply->user->id)}}">
                                                    <img src="{{ $reply->user->image }}"
                                                         class="testimonial-img flex-shrink-0 reply-user-image clickable-item"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="col" style="margin-left: -25px;">
                                                <a href="{{route('users.publicProfile', $reply->user->id)}}">
                                                    <h3 style="margin-bottom: -5px"
                                                        class="clickable-item">{{$reply->user->name}}</h3>
                                                </a>
                                                <span class="forum-post text-muted reply-text">
                                                    {!! \Illuminate\Support\Str::markdown($reply->text) !!}
                                                </span>
                                            </div>
                                            <div class="col-auto d-flex align-items-center align-middle">
                                                @if (Auth::user() && $reply->likes->contains(Auth::user()->id))
                                                    <i class="bi bi-heart-fill like-button reply-like-button liked clickable-item"
                                                       data-post-id="{{ $reply->id }}"
                                                       title="Unlike this reply"></i>
                                                @else
                                                    <i class="bi bi-heart like-button reply-like-button clickable-item"
                                                       data-post-id="{{ $reply->id }}"
                                                       title="Like this reply"></i>
                                                @endif
                                                @if ($reply->likes->count() > 0)
                                                    <span class="likes-count" data-post-id="{{ $reply->id }}">
                                                        {{ $reply->likes->count() > 0 ? $reply->likes->count() : '' }}
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach

                                    <!-- Formulario de respuesta -->
                                    @auth
                                        <form method="POST" action="{{ route('forum.replyPost', $post->id) }}"
                                              class="mt-3" enctype="multipart/form-data" data-post-id="{{ $post->id }}">
                                            @csrf
                                            <div class="row">
                                                <div class="col-12 col-md-9">
                                                    <input type="text" name="reply"
                                                           class="form-control reply-input clickable-item"
                                                           placeholder="Add a reply..." required>
                                                </div>
                                                <div class="col-12 col-md-3 mt-2 mt-md-0 d-flex flex-column flex-md-row justify-content-between">
                                                    <label for="replyImageUpload"
                                                           class="btn-auth mb-2 mb-md-0 mr-md-2 clickable-item"
                                                           style="padding: 10px 15px;border-radius: 15px">
                                                        <i class="bi bi-upload clickable-item" style="font-size: 34px;"></i>
                                                    </label>
                                                    <input type="file" name="images[]" id="replyImageUpload"
                                                           class="form-control clickable-item replyImageUpload"
                                                           multiple accept="image/*" style="display: none;"
                                                           data-post-id="{{ $post->id }}">
                                                    <button type="submit"
                                                            class="btn-auth reply-btn w-100 clickable-item">
                                                        Reply
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div id="replyImageGallery"
                                                         class="image-gallery d-flex flex-wrap"
                                                         data-post-id="{{ $post->id }}"></div>
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
                    <button type="button" class="btn-auth" data-bs-dismiss="modal">Cancel</button>
                    <form id="deletePostForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-auth">Delete</button>
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
            var postContainers = document.querySelectorAll('.forum-post-container');

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

            postContainers.forEach(function (postContainer) {
                // Agrega un evento de clic al contenedor del post
                postContainer.addEventListener('click', function (event) {
                    // Evita que el evento se dispare cuando se hace clic en un objeto clickable interno
                    if (!event.target.classList.contains('clickable-item')) {
                        var postId = this.getAttribute('data-post-id');
                        window.location.href = '/forum/' + postId;
                    }
                });
            });

            var replyImageUploads = document.querySelectorAll('.replyImageUpload');

            replyImageUploads.forEach(function(replyImageUpload) {
                replyImageUpload.addEventListener('change', function () {
                    var postId = this.parentElement.getAttribute('data-post-id');
                    console.log("POST ID: " + postId);
                    var imageGallery = document.querySelector('.image-gallery[data-post-id="' + postId + '"]');
                    if (imageGallery) {
                        imageGallery.innerHTML = '<h1> ' + postId + '  POST ID </h1>'; // Clear the gallery

                        if (this.files.length > 4) {
                            alert('You can only upload up to 4 images.');
                            this.value = '';
                        } else {
                            for (var i = 0; i < this.files.length; i++) {
                                var img = document.createElement('img');
                                img.src = URL.createObjectURL(this.files[i]);
                                img.className = 'img-fluid';
                                img.alt = 'Preview';
                                imageGallery.appendChild(img);
                            }
                        }
                    }
                });
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
                    return '<img class="tribute-list-img" src="' + item.original.image + '">' + item.original.name;
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
