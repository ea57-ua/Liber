@extends('layouts.master')
@section('title', 'Liber - Welcome')
@section('content')

    <h1>Forum page</h1>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form method="POST" action="{{route('forum.newPost')}}">
                    @csrf
                    <div class="form-group">
                        <textarea id="postInput" class="form-control forum-post-input"
                                  name="text"
                                  placeholder="What do you have in mind?"></textarea>
                    </div>
                    <div class="row justify-content-end">
                        <div id="advancedEditorOption" class="col-auto mt-3" style="display: none;">
                            <button type="button" class="btn-auth forum-post-btn"
                                    data-bs-toggle="modal" data-bs-target="#advancedEditorModal">
                                Advanced editor
                            </button>
                        </div>
                        <div class="col-auto form-group text-right">
                            @auth()
                            <button type="submit" class="btn-auth forum-post-btn mt-3 mb-4">
                                Post
                            </button>
                            @endauth
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="advancedEditorModal" tabindex="-1"
         role="dialog" aria-labelledby="advancedEditorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="advancedEditorModalLabel">Advanced Editor</h5>
                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="advancedEditor">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    @foreach($posts as $post)
        <h1> {{$post->user->name}}  :  {{$post->text}}</h1>
    @endforeach

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('postInput').addEventListener('click', function() {
                document.getElementById('advancedEditorOption').style.display = 'block';
            });
        });
    </script>
