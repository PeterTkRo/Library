@extends('layout')
@section('content')
    <table class="table table-bordered">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roles</th>
            <th>Action</th>
        </tr>
        @foreach ($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ array_search($user->role, $roles) }}</td>
                <td>
                    <a type="submit" class="btn btn-danger" href="{{ route('admin.user.delete',$user->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $users->links() !!}
@endsection
