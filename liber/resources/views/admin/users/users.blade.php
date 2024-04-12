@extends('layouts.admin')
@section('content')
    <div class="pagetitle">
        <h1>Registered Users</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
            </ol>
        </nav>
    </div>

    <a href="{{route('admin.users.create')}}" class="btn">Create user</a>

    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Movies list</h5>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Biography</th>
                        <th scope="col"></th>
                        <th scope="col">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <a href="{{route('users.publicProfile', $user->id)}}">{{$user->name}}</a>
                                @if($user->admin)
                                    <i class="bi bi-person-gear"
                                       style="font-size: 20px;" title="Admin user"></i>
                                @endif
                                @if($user->critic)
                                    <i class="bi bi-person-check"
                                       style="font-size: 20px;" title="Critic user"></i>
                                @endif
                            </td>
                            <td>{{$user->email}}</td>
                            <td>{{ \Illuminate\Support\Str::limit($user->biography, 100, '...') }}</td>
                            <td>
                                @if($user->blocked)
                                    <i class='bx bx-block' title="Blocked user" style="font-size: 22px;"></i>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex;">
                                    <div style="margin-right: 10px">
                                        <button type="button" class="btn btn-primary"
                                                data-bs-toggle="modal"
                                                data-bs-target="#userDetailsModal{{$user->id}}">
                                            See details
                                        </button>
                                    </div>

                                    <div style="margin-right: 10px">
                                        <button type="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$user->id}}">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="userDetailsModal{{$user->id}}"
                             tabindex="-1" aria-labelledby="userDetailsModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="userDetailsModalLabel">User Details</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="row">
                                            <div class="card">
                                                <div class="card-body pt-3">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <a href="{{route('users.publicProfile', $user->id)}}"
                                                           style="display: flex; align-items: center;">
                                                            <img src="{{$user->image}}" alt="User photo"
                                                                 style="width: 50px; height: 50px;" class="rounded-5 me-3">
                                                            <h4><strong>{{$user->name}}</strong></h4>
                                                        </a>
                                                        <form method="POST"
                                                              action="{{ route('admin.users.toggleBlock', $user->id) }}">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="btn btn-warning">
                                                                {{ $user->blocked ? 'Unblock' : 'Block' }}
                                                            </button>
                                                        </form>
                                                    </div>
                                                    <p><strong>Email:</strong>
                                                        <span style="font-size: 1.2em;">
                                                            {{$user->email}}
                                                        </span></p>
                                                    <p><strong>Biography:</strong>
                                                        <span style="font-size: 1.2em;">
                                                            {{$user->biography}}
                                                        </span></p>
                                                    <p><strong>Account created on:</strong>
                                                        <span style="font-size: 1.2em;">
                                                            {{$user->created_at->format('d-m-Y')}}
                                                        </span></p>
                                                    <p><strong>Roles:</strong>
                                                        @if($user->admin)
                                                            <span class="badge bg-primary"
                                                                  style="font-size: 1em; padding: .2em .6em;">
                                                                Admin
                                                            </span>
                                                        @endif
                                                        @if($user->critic)
                                                            <span class="badge bg-primary"
                                                                  style="font-size: 1em; padding: .2em .6em;">
                                                                Critic</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="deleteModal{{$user->id}}" tabindex="-1"
                             aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm User Account Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong>{{$user->name}}</strong> account ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" action="{{ route('admin.users.destroy', ['id' => $user->id]) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Confirm Delete</button>
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
        {{-- Pagination --}}
        {!! $users->links() !!}
    </section>
@endsection


