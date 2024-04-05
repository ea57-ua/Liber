@extends('layouts.master')
@section('title', 'Liber - Forum')
@section('content')
    <br>
    <section id="testimonials" class="testimonials">
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
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection

@push('scripts')
    <script src="{{asset('js/likePostAndReplay.js')}}"></script>
@endpush