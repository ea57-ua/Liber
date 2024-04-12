@extends('layouts.admin')
@section('content')

    <div class="row align-items-center">
        <div class="col-md-8">
            <div class="pagetitle">
                <h1>Actors</h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Actors</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-md-4 text-end mb-3 d-flex align-items-center justify-content-end">
            <a href="{{route('admin.actors.create')}}" class="btn btn-lg btn-info">Add actor</a>
        </div>
    </div>


    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Actors list</h5>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Description</th>
                        <th scope="col">Actions</th>
                    </thead>

                    <tbody>
                    @foreach($actors as $actor)
                        <tr>
                            <td><a href="{{route('actors.details', $actor->id)}}">{{$actor->name}}</a></td>
                            <td>{{ \Illuminate\Support\Str::limit($actor->description, 120, '...') }}</td>
                            <td>
                                <div style="display: flex;">
                                    <div style="margin-right: 10px">
                                        <a href="#" class="btn btn-primary"
                                           data-bs-toggle="modal"
                                           data-bs-target="#editModal{{$actor->id}}">
                                            <i class='bx bx-edit'></i>
                                            Edit
                                        </a>
                                    </div>
                                    <div style="margin-right: 10px">
                                        <button type="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$actor->id}}">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteModal{{$actor->id}}"
                             tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong>{{$actor->name}}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" action="{{route('admin.actors.destroy', ['id' => $actor->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editModal{{$actor->id}}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel">Edit Actor</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form method="POST" action="{{route('admin.actors.update', ['id' => $actor->id])}}">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" id="name" name="name" value="{{$actor->name}}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="description">Description</label>
                                                <textarea class="form-control" id="description"
                                                          name="description" rows="12"
                                                          required>{{$actor->description}}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="photo_url">Photo URL</label>
                                                <input type="text" class="form-control" id="photo_url" name="photo_url" value="{{$actor->photo}}" required>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="justify-content-center">
            {{ $actors->links() }}
        </div>
    </section>
@endsection
