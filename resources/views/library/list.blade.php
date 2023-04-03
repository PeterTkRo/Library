@extends('layout')
@section('content')
    <a class="btn btn-primary" href="{{ route('createBook') }}">Create</a>
    <table class="table table-bordered">
        <tr>
            <th>ISBN</th>
            <th>Name</th>
            <th>Author</th>
            <th>Genre</th>
            <th>Action</th>
        </tr>
        <tr>
            <form action="{{ route('library') }}" method="GET">
                <th><input type="text" name="ISBN" value="{{ $search['ISBN'] ?? '' }}" class="form-control"></th>
                <th><input type="text" name="name" value="{{  $search['name'] ?? '' }}" class="form-control"></th>
                <th><input type="text" name="author" value="{{  $search['author'] ?? '' }}" class="form-control"></th>
                <th>
                    <select class="form-select" name="genre" aria-label="Genre">
                        <option value="-1" {{ isset($search['genre']) ? '' : 'selected' }} >All genres</option>
                        @foreach($genres as $genre => $genreID)
                            <option value="{{ $genreID }}" {{ $genreID == ($search['genre'] ?? -1) ? 'selected' : '' }} >{{ $genre }}</option>
                        @endforeach
                    </select>
                </th>
                <th>
                    <button type="submit" class="btn btn-primary">Search</button>
                    <a type="submit" class="btn btn-primary" href="{{ route('library') }}">Clear</a>
                </th>
            </form>
        </tr>
        @foreach ($books as $book)
            <tr>
                <td>{{ $book->ISBN }}</td>
                <td>{{ $book->name }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ array_search($book->genre, $genres) }}</td>
                <td>
                    <a type="submit" class="btn btn-success" href="{{ route('viewBook',$book->id) }}">Show</a>
                    <a type="submit" class="btn btn-warning" href="{{ route('editBook',$book->id) }}">Edit</a>
                    <a type="submit" class="btn btn-danger" href="{{ route('deleteBook',$book->id) }}">Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    {!! $books->links() !!}
@endsection
