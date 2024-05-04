@extends('layouts.master')
@section('title', 'Liber - Forum Post Details')
@section('content')
    <br>
    <section id="testimonials" class="testimonials mb-5">
        <div class="container" data-aos="fade-up">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10 col-lg-10">
                    <div class="testimonial-wrap">
                        <div class="testimonial-item forum-post-container">
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
                                                <button type="button"
                                                        class="btn navbarDropDownButton forum-post-options clickable-item"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deletePostModal"
                                                        data-post-id="{{ $post->id }}">
                                                    Delete
                                                </button>
                                            </li>
                                        @endif
                                        @if(Auth::user()->admin)
                                            <li>
                                                <button type="button"
                                                        class="btn navbarDropDownButton forum-post-options clickable-item"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deletePostModal"
                                                        data-post-id="{{ $post->id }}"
                                                        style="color: red">
                                                    Admin delete
                                                </button>
                                            </li>
                                        @endif
                                        <li>
                                            <button type="button"
                                                    class="dropdown-item navbarDropDownButton forum-post-options clickable-item"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#reportPostModal">
                                                Report
                                            </button>
                                        </li>
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
                                    <button id="share-button" class="btn btn-block"
                                            data-bs-toggle="modal"
                                            data-bs-target="#sharePostModal"
                                            data-post-id="{{ $post->id }}"
                                            style="border: none;">
                                        <i class="bi bi-share" title="Share post" style="font-size: 32px;"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="modal fade" id="sharePostModal" tabindex="-1"
                                 aria-labelledby="sharePostModal" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="sharePostModalLabel">
                                                Share Liber Post</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="input-group mb-3">
                                                <input type="text" id="post-link" class="form-control" readonly>
                                                <button class="btn btn-outline-secondary" type="button"
                                                        id="copy-post-link-button">
                                                    <i class="bi bi-clipboard"></i>
                                                </button>
                                            </div>
                                            <div id="share-links-container" class="share-links-container"></div>
                                        </div>
                                    </div>
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


                            @auth  <!-- Formulario de respuesta -->
                            <form method="POST" action="{{ route('forum.replyPost', $post->id) }}"
                                      class="mt-3">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12 col-md-9">
                                            <input type="text" name="reply"
                                                   class="form-control reply-input clickable-item"
                                                   placeholder="Add a reply..." required>
                                        </div>
                                        <div class="col-12 col-md-3 mt-2 mt-md-0">
                                            <button type="submit" class="btn-auth reply-btn w-100 clickable-item">
                                                Reply
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endauth

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

                            <div class="modal fade" id="reportPostModal" tabindex="-1" role="dialog"
                                 aria-labelledby="reportPostModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="reportPostModalLabel">Report Post</h5>
                                            <button type="button" class="btn-close"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                            </button>
                                        </div>
                                        <form method="POST" id="reportPostForm"
                                              action="{{ route('forum.reportPost', $post->id) }}">
                                            @csrf
                                            @method('POST')
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="reportReason">Reason</label>
                                                    <textarea class="form-control" id="reportReason" rows="5"
                                                              name="reason" required></textarea>
                                                </div>
                                                <div class="form-group">
                                                    <label for="reportCategory">Category</label>
                                                    <select class="form-control" id="reportCategory" name="category" required>
                                                        <option value="">Select a category</option>
                                                        <option value="spam">Spam</option>
                                                        <option value="harassment">Harassment</option>
                                                        <option value="abuse">Abuse</option>
                                                        <option value="inappropriate">Inappropriate Content</option>
                                                        <option value="hate_speech">Hate Speech</option>
                                                        <option value="privacy">Privacy Violation</option>
                                                        <option value="bullying">Bullying</option>
                                                        <option value="other">Other</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn-auth">Report</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{asset('js/likePostAndReplay.js')}}"></script>

    <script>
        var shareButton = document.getElementById('share-button');
        if (shareButton) {
            shareButton.addEventListener('click', function () {
                var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                var postId = this.getAttribute('data-post-id');

                fetch('/forum/' + postId + '/share', {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                })
                    .catch(error => console.error('Error:', error))
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.json();
                    })
                    .then(data => {
                        if (data.error) {
                            console.error('Error sharing post:', data.error);
                        } else {
                            var shareLinksContainer = document.getElementById('share-links-container');
                            shareLinksContainer.innerHTML = '';

                            document.getElementById('post-link').value = data.url;

                            for (var platform in data.shareComponent) {
                                if (platform !== 'copy') {
                                    var link = data.shareComponent[platform];
                                    var button = document.createElement('a');
                                    button.href = link;
                                    button.target = '_blank';
                                    button.className = 'btn btn-auth m-2';
                                    button.innerHTML = '<i class="share-links-item bi bi-' + platform + '"></i>';
                                    shareLinksContainer.appendChild(button);
                                }
                            }

                            var shareModalElement = document.getElementById('shareMovieModal');
                            var shareModal = bootstrap.Modal.getInstance(shareModalElement);
                            if (!shareModal) {
                                shareModal = new bootstrap.Modal(shareModalElement);
                            }
                            shareModal.show();
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        }

        var copyPostLinkButton = document.getElementById('copy-post-link-button');
        if (copyPostLinkButton) {
            copyPostLinkButton.addEventListener('click', function () {
                var postLink = document.getElementById('post-link');
                postLink.select();
                document.execCommand('copy');
            });
        }

        var deletePostModal = document.getElementById('deletePostModal');
        deletePostModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget;
            var postId = button.getAttribute('data-post-id');

            var deletePostForm = deletePostModal.querySelector('#deletePostForm');
            deletePostForm.setAttribute('action', '/forum/' + postId + '/delete');
        });
    </script>
@endpush
