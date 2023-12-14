@extends('layouts.app')

@section('page-actions')
    <a class="page-action-link" href="{{ route('books.index') }}">← Back</a>

@endsection

@section('title', $book->title)

@section('content')
    <div class="flex align-content-center">
        <div>
            <p class="book-isbn"><strong>ISBN: </strong>{{ $book->isbn }}</p>
        </div>
        <div class="mx-3">•</div>
        <div>
            <p class="book-isbn"><strong>Author: </strong>{{ $book->author }}</p>
        </div>
    </div>

    <div class="max-h-min">
        @forelse ($reviews as $review)
            <p>{{ $review->comment }}</p>
        @empty
            <p>There are no reviews for this book. Let's add one!</p>
        @endforelse
    </div>

    <a class="primary-btn fixed bottom-5 right-5">+ Add Review For this Book</a>
@endsection
