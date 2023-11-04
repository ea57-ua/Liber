@extends('layouts.admin')
@section('content')
    <div class="details">
        <div class="recentOrders">
            <div class="cardHeader">
                <h2>Users</h2>
                <a href="{{route('admin.users.create')}}" class="btn">Create user</a>
            </div>

            <table>
                <thead>
                <tr>
                    <td>Name</td>
                    <td>Surname</td>
                    <td>Email</td>
                    <td>Biography</td>
                    <td>Admin</td>
                    <td>Actions</td>
                </tr>
                </thead>

                <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->surname}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->biography}}</td>
                    <td><input type="checkbox" value="1" {{ $user->admin == '1' ? 'checked' : '' }} disabled></td>

                    <td>
                        <form method="POST" action="{{ route('admin.users.destroy', ['id' => $user->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach

                </tbody>
            </table>
            {{-- Pagination --}}
            {!! $users->links() !!}
        </div>
@endsection


