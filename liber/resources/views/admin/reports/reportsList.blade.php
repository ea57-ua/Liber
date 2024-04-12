@extends('layouts.admin')
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
                        <th scope="col">Reported post</th>
                        <th scope="col">Actions</th>
                    </thead>

                    <tbody>
                    @foreach($reports as $report)
                        <tr>
                            <td><a href="{{route('users.publicProfile', $movie->id)}}">{{$report->user->name}}</a></td>
                            <td>{{ \Illuminate\Support\Str::limit($movie->synopsis, 100, '...') }}</td>
                            <td>{{ \Carbon\Carbon::parse($movie->releaseDate)->format('Y') }}</td>
                            <td>

                            </td>
                        </tr>

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
