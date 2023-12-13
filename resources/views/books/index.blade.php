@extends('layouts.app')

@section('page-actions')
    <a class="page-action-link" href="{{ route('books.create') }}">+ Add New Book</a>
@endsection

@section('title', 'All Books!')

@section('content')

    @forelse ($books as $book)
        <a href="{{ route('books.show', ['book' => $book]) }}">
            <div class="book-card">
                <div class="mb-3">
                    <p class="book-isbn">
                        <strong class="font-bold">ISBN: </strong> {{ $book->isbn }}
                    </p>
                </div>
                <div class="book-title">
                    <p>{{ $book->title }}</p>
                </div>
                <div class="ml-4">
                    <p class="book-author">{{ $book->author }}</p>
                </div>
            </div>
        </a>
    @empty
        <div>there are no books yet! Try Add One</div>
    @endforelse

@endsection
