@extends('layouts.admin')
@section('content')

    <div class="pagetitle">
        <h1>Movies</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                <li class="breadcrumb-item active">Movies</li>
            </ol>
        </nav>
    </div>

    <section>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Movies list</h5>

                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Synopsis</th>
                        <th scope="col">Year</th>
                        <th scope="col">Actions</th>
                    </thead>

                    <tbody>
                    @foreach($movies as $movie)
                        <tr>
                            <td><a href="{{route('movies.details', $movie->id)}}">{{$movie->title}}</a></td>
                            <td>{{ \Illuminate\Support\Str::limit($movie->synopsis, 100, '...') }}</td>
                            <td>{{ \Carbon\Carbon::parse($movie->releaseDate)->format('Y') }}</td>
                            <td>
                                <div style="display: flex;">
                                    <div style="margin-right: 10px">
                                        <a href="{{route('admin.movies.show', $movie->id)}}" class="btn btn-primary">
                                            <i class='bx bx-edit'></i>
                                            More
                                        </a>
                                    </div>
                                    <div style="margin-right: 10px">
                                        <button type="button" class="btn btn-danger"
                                                data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{$movie->id}}">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </div>
                                </div>
                        </tr>

                        <!-- Delete confirmation modal -->
                        <div class="modal fade" id="deleteModal{{$movie->id}}" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete <strong>{{$movie->title}}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        <form method="POST" action="{{route('admin.movies.destroy', ['id' => $movie->id])}}">
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

        <div class="justify-content-center">
            {{ $movies->links() }}
        </div>
    </section>


<a href="{{route('admin.movies.create')}}" class="btn">Create movie</a>



@endsection
