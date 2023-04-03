@extends('layout')
@section('content')
    <a class="btn btn-primary" href="{{ redirect()->back()->getTargetUrl() }}">Back</a>
    <table class="table table-bordered">
        <tr>
            <th>ISBN</th>
            <th>{{ $book->ISBN }}</th>
        </tr>
        <tr>
            <th>Name</th>
            <th>{{ $book->name }}</th>
        </tr>
        <tr>
            <th>Author</th>
            <th>{{ $book->author }}</th>
        </tr>
        <tr>
            <th>Genre</th>
            <th>{{ array_search($book->genre, $genres) }}</th>
        </tr>
        <tr>
            <th>Publishing house</th>
            <th>{{ $book->publishing_house }}</th>
        </tr>
        <tr>
            <th>Publication date</th>
            <th>{{ $book->publication_date }}</th>
        </tr>
    </table>
@endsection
