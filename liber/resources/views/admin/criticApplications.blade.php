@extends('layouts.admin')
@section('content')

    <div class="pagetitle">
        <h1>Critic Applications</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Critic Applications</li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Critic status applications</h5>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Application title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($requests as $req)
                    <tr>
                        <td>{{$req->user->name}}</td>
                        <td>{{$req->title}}</td>
                        <td>{{ \Illuminate\Support\Str::limit($req->description, 80, '...') }}</td>
                        <td>{{ $req->created_at->format('d-m-Y H:i') }}</td>
                        <td>
                            @switch($req->state)
                                @case(App\Enums\CriticRequestState::Pending->value)
                                    <i class="bi bi-hourglass" style="font-size: 22px"
                                    title="Pending request"></i>
                                    @break
                                @case(App\Enums\CriticRequestState::Approved->value)
                                    <i class="bi bi-check-circle" style="font-size: 22px"
                                    title="Approved request"></i>
                                    @break
                                @case(App\Enums\CriticRequestState::Rejected->value)
                                    <i class="bi bi-x-circle" style="font-size: 22px"
                                    title="Rejected request"></i>
                                    @break
                                @default
                                    <i class="bi bi-question-circle" style="font-size: 22px"
                                    title="Unknown state"></i>
                            @endswitch
                        </td>
                        <td>
                            <button type="button" class="btn btn-primary"
                                    data-bs-toggle="modal"
                                    data-bs-target="#requestModal{{$req->id}}">
                                View
                            </button>
                        </td>
                    </tr>

                    <div class="modal fade" id="requestModal{{$req->id}}" tabindex="-1"
                         role="dialog" aria-labelledby="requestModalLabel{{$req->id}}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="requestModalLabel{{$req->id}}">Request Details</h5>
                                    <button type="button" class="btn-close bg-light" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    @if($req->state == App\Enums\CriticRequestState::Approved->value)
                                        <div class="alert alert-success" role="alert">
                                            <strong>Approved</strong>
                                        </div>
                                    @elseif($req->state == App\Enums\CriticRequestState::Rejected->value)
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Rejected</strong>
                                        </div>
                                    @else
                                        <div class="alert alert-warning" role="alert">
                                            <strong>Pending</strong>
                                        </div>
                                    @endif
                                    <p><strong>User:</strong><a href="{{route('users.publicProfile', $req->user->id)}}"> {{$req->user->name}}</a></p>
                                    <p><strong>Application Title:</strong> {{$req->title}}</p>
                                    <p><strong>Description:</strong> {{$req->description}}</p>
                                    <p><strong>Date:</strong> {{$req->created_at->format('d-m-Y H:i')}}</p>
                                    @if($req->file)
                                        <p>
                                            <strong>File:</strong>
                                            <a href="{{ asset($req->file) }}" class="btn btn-primary ms-2" download>
                                                <i class="bi bi-download"></i> <strong>Download</strong>
                                            </a>
                                        </p>
                                    @endif

                                    <form action="{{ route('admin.applications.update', $req->id) }}"
                                          method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="decision{{$req->id}}">Decision</label>
                                            <textarea class="form-control" id="decision{{$req->id}}"
                                                      name="decision" rows="3"
                                                      placeholder="Enter your decision"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="status{{$req->id}}">Status</label>
                                            <select class="form-control" id="status{{$req->id}}" name="status">
                                                <option value="{{ App\Enums\CriticRequestState::Approved }}">Approve</option>
                                                <option value="{{ App\Enums\CriticRequestState::Rejected }}">Reject</option>
                                            </select>
                                        </div>
                                        <div class="form-group text-end mt-4">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </form>
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
            {{ $requests->links() }}
        </div>
    </section>
@endsection
