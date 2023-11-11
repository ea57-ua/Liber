@extends('layouts.admin')
@section('content')
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Movies</h2>
                <a href="" class="btn">Create movie</a>
            </div>

            <table>
                <thead>
                <tr>
                    <td>Title</td>
                    <td>Year</td>
                    <td>Duration</td>
                    <td>Genre</td>
                    <td>Director</td>
                    <td>Actions</td>
                </thead>

                <tbody>
                    @foreach($movies as $movie)
                    <tr>
                        <td>{{$movie->title}}</td>
                        <td>{{$movie->year}}</td>
                        <td>{{$movie->duration}}</td>
                        <td>{{$movie->genre}}</td>
                        <td>{{$movie->director}}</td>
                        <td>
                            <div style="display: flex;">
                                <div style="margin-right: 10px">
                                    <a href="" class="btn btn-primary">See details</a>
                                </div>
                                <div style="margin-right: 10px">
                                    <form method="POST" action="">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                                <div>
                                    <a href="" class="btn btn-info">Edit</a>
                                </div>
                            </div>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
