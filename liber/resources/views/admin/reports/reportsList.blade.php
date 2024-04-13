@extends('layouts.admin')
@section('title', 'LiberAdmin - Reports List')
@section('content')

    <div class="pagetitle">
        <h1>Reports</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Reports</li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Reports list</h5>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Reporter</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Category</th>
                        <th scope="col">Reported</th>
                        <th scope="col">Post</th>
                        <th scope="col"></th>
                        <th scope="col">Actions</th>
                    </thead>

                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td>
                                <a href="{{route('users.publicProfile', $report->user->id)}}">{{$report->user->name}}</a>
                            </td>
                            <td>{{ \Illuminate\Support\Str::limit($report->reason, 50, '...') }}</td>
                            <td>{{$report->category}}</td>
                            <td>
                                <a href="{{route('users.publicProfile', $report->post->user->id)}}">{{$report->post->user->name}}</a>
                            </td>
                            <td>
                                @if($report->post->trashed())
                                    {{ \Illuminate\Support\Str::limit($report->post->text, 50, '...') }}
                                @else
                                    <a href="{{route('forum.showPost', $report->post->id)}}">
                                        {{ \Illuminate\Support\Str::limit($report->post->text, 50, '...') }}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if($report->state == 'pending')
                                    <i class="bi bi-hourglass" style="font-size: 22px"
                                       title="Pending report"></i>
                                @elseif($report->state == 'resolved')
                                    <i class="bi bi-check-circle" style="font-size: 22px; color: green"
                                       title="Resolver report"></i>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex;">
                                    <div style="margin-right: 10px">
                                        <a href="#" class="btn btn-primary"
                                           data-bs-toggle="modal"
                                           data-bs-target="#reportModal{{$report->id}}">
                                            <i class="bi bi-eye"></i>
                                            View
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="reportModal{{$report->id}}" tabindex="-1"
                             role="dialog" aria-labelledby="reportModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="reportModalLabel">Report Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <h5>Reporter</h5>
                                                <p><strong>Name:</strong>
                                                    <a href="{{route('users.publicProfile', $report->user->id)}}">
                                                        {{$report->user->name}}
                                                    </a></p>
                                                <p><strong>Report Date:</strong>
                                                    {{$report->created_at->format('d-m-Y')}}
                                                </p>
                                                <p><strong>Category:</strong>
                                                    <span
                                                        class="badge bg-primary ms-2"
                                                        style="font-size: 14px;">{{$report->category}}</span>
                                                </p>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Reason</h5>
                                                        <p class="card-text">{{$report->reason}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <h5>Reported</h5>
                                                <p><strong>User:</strong>
                                                    <a href="{{route('users.publicProfile', $report->post->user->id)}}">
                                                        {{$report->post->user->name}}</a></p>
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">Post</h5>
                                                        <p class="card-text">
                                                            @if($report->post->trashed())
                                                                {{ \Illuminate\Support\Str::limit($report->post->text, 50, '...') }}
                                                            @else
                                                                <a href="{{route('forum.showPost', $report->post->id)}}">
                                                                    {{ \Illuminate\Support\Str::limit($report->post->text, 50, '...') }}
                                                                </a>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                @if($report->state == 'resolved')
                                                    <div class="alert alert-success" role="alert">
                                                        <strong>Resolved</strong>
                                                    </div>
                                                @endif
                                                <form method="POST" id="resolveForm"
                                                      action="{{ route('reports.resolve', $report->id) }}">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="action"><strong>Action</strong>:</label>
                                                        <select class="form-control" id="action" name="action">
                                                            <option value="delete_post">Delete post</option>
                                                            <option value="block_user">Block user</option>
                                                            <option value="delete_post_and_block_user">Delete post and block user</option>
                                                            <option value="nothing">Nothing</option>
                                                        </select>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            Close
                                        </button>
                                        <button type="button" class="btn btn-primary"
                                                onclick="document.getElementById('resolveForm').submit();">
                                            Resolve
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div>

        <div class="justify-content-center">
            {{ $reports->links() }}
        </div>
    </section>

@endsection
