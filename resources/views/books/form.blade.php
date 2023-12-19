@extends('layouts.app')

@section('page-actions')
    <a class="page-action-link" href="{{ isset($book) ? route('books.show', ['book' => $book]) : route('books.index') }}">
        ← Back
    </a>
@endsection

@section('title', isset($book) ? 'Edit ' . $book->title : 'Add New Book')

@section('content')
    <form method="post" action="{{ isset($book) ? route('books.update', ['book' => $book]) : route('books.store') }}">
        @csrf
        @isset($book)
            @method('put')
        @endisset
        <div class="flex flex-col mb-2">
            <label for="isbn" class="form-label">Book ISBN</label>
            <input type="text" id="isbn" name="isbn" class="form-input"
                value="{{ isset($book) ? $book->isbn : old('isbn') }}" required />
            @error('isbn')
                <div>
                    <p class="error-message">{{ $message }}</p>
                </div>
            @enderror
        </div>
        <div class="flex flex-col mb-2">
            <label for="title" class="form-label">Book Title</label>
            <input type="text" id="title" name="title" class="form-input"
                value="{{ isset($book) ? $book->title : old('title') }}" required />
            @error('title')
                <div>
                    <p class="error-message">{{ $message }}</p>
                </div>
            @enderror
        </div>
        <div class="flex flex-col mb-2">
            <label for="author" class="form-label">Book Author</label>
            <input type="text" id="author" name="author" class="form-input"
                value="{{ isset($book) ? $book->author : old('author') }}" required />
            @error('author')
                <div>
                    <p class="error-message">{{ $message }}</p>
                </div>
            @enderror
        </div>
        <div class="mt-4">
            <button type="submit" class="primary-btn">
                @isset($books)
                    Save Changes
                @else
                    Save Book
                @endisset
            </button>
            <a class="secondary-btn"
                href="{{ isset($book) ? route('books.show', ['book' => $book]) : route('books.index') }}">Cancel</a>
        </div>
    </form>
@endsection
