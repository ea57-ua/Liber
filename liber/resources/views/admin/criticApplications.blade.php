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

                <!-- Table with stripped rows -->
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">User</th>
                        <th scope="col">Application title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Date</th>
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
                                    <p><strong>User:</strong> {{$req->user->name}}</p>
                                    <p><strong>Application Title:</strong> {{$req->title}}</p>
                                    <p><strong>Description:</strong> {{$req->description}}</p>
                                    <p><strong>Date:</strong> {{$req->created_at->format('d-m-Y H:i')}}</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
