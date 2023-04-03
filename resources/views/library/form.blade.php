@extends('layout')
@section('content')
    <a class="btn btn-primary" href="{{ redirect()->back()->getTargetUrl() }}">Back</a>
    <form action="{{ route('saveBook', $book->id ?? []) }}" method="POST">
    @csrf
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="name" class="form-label">Name:</label>
                <input type="text" name="name" value="{{ $book->name ?? '' }}" class="form-control" placeholder="Name">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="ISBN" class="form-label">ISBN:</label>
                <input type="text" name="ISBN" value="{{ $book->ISBN ?? ''}}" class="form-control" placeholder="ISBN">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="author" class="form-label">Author:</label>
                <input type="text" name="author" value="{{ $book->author ?? ''}}" class="form-control" placeholder="author">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="genre" class="form-label">Genre:</label>
                <select class="form-select" name="genre" aria-label="Genre">
                @foreach($genres as $genre => $genreID)
                    <option value="{{ $genreID }}" {{ $genreID == ($book->genre ?? -1) ? 'selected' : '' }} >{{ $genre }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="publishing_house" class="form-label">Publishing house:</label>
                <input type="text" name="publishing_house" value="{{ $book->publishing_house ?? ''}}" class="form-control" placeholder="Publishing house">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="publication_date" class="form-label">Publication date (format - 2023-12-30):</label>
                <input type="text" name="publication_date" value="{{ $book->publication_date ?? ''}}" class="form-control" placeholder="Publication date">
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
    </form>
@endsection
