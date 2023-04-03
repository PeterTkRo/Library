@extends('layout')
@section('content')
    <div class="row">
        Hi, {{ $user->name }}
    </div>
    <div class="row">
        <div class="col-lg-4">
            <a class="btn btn-primary" role="button" href="{{ route('library') }}"> To Library</a>
        </div>
        @if($user->role == \App\Models\User::ROLES['ADMIN'])
            <div class="col-lg-4">
                <a class="btn btn-primary" role="button" href="{{ route('admin.users') }}"> To Users</a>
            </div>
        @endif
    </div>
@endsection
