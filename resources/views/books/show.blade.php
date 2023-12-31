@extends('layouts.app')

@php
    $pageTitle = 'Book Details';
@endphp

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

    <div class="my-10 flex">
        <a href="{{ route('books.edit', ['book' => $book]) }}" class="primary-btn mr-4">
            Edit Book Info
        </a>
        <form method="post" action="{{ route('books.destroy', ['book' => $book]) }}">
            @csrf
            @method('delete')
            <button type="submit" class="danger-btn">
                Delete Book
            </button>
        </form>
    </div>

    <div class="mt-4 flex flex-col bg-gray-100 py-2 px-4 rounded-lg">
        <div>
            <p class="font-semibold text-2xl">📖 Book Reviews</p>
        </div>
        <div class="flex flex-row mt-2">
            <div class="mr-5 self-center">
                <x-star-rating :rating="round($avg_rating, 2)" />
            </div>
            <div class="flex flex-col">
                <div>{{ Str::plural('star', $avg_rating) }}</div>
                <div>Based on <strong>{{ count($book->reviews) }}</strong>
                    {{ Str::plural('rating', count($book->reviews)) }}
                </div>
            </div>
        </div>
    </div>

    <div class="max-h-min mt-4">
        <div>
            <p class="font-semibold text-2xl mb-4">Reviews</p>
        </div>
        <hr>
        @forelse ($reviews as $review)
            <div>
                <div class="mt-3 flex justify-between">
                    <div class="flex">
                        <p>
                            <x-star-rating :rating="round($review->rating, 2)" />
                            <span class="mr-2">{{ Str::plural('star', $review->rating) }}</span>
                        </p>
                        •
                        <p class="ml-2 book-isbn">posted {{ $review->created_at->diffForHumans() }}</p>
                    </div>
                    <div class="flex gap-x-4">
                        <a href="{{ route('books.reviews.edit', compact('book', 'review')) }}" class="text-slate-700">
                            Edit
                        </a>
                        <form method="post" action="{{ route('books.reviews.destroy', compact('book', 'review')) }}">
                            @csrf
                            @method('delete')
                            <button type="submit" class="text-red-700">Delete</button>
                        </form>
                    </div>

                </div>
                <div>
                    <p class="my-2">{{ $review->comment }}</p>
                </div>
            </div>
            <hr>
        @empty
            <p class="my-3">There are no reviews for this book. Let's add one!</p>
        @endforelse
        <hr class="mb-10">
    </div>

    <div class="mb-20">
        {{ $reviews->links() }}
    </div>
    <a class="primary-btn fixed bottom-5 right-5" href="{{ route('books.reviews.create', ['book' => $book]) }}">
        + Add Review For this Book
    </a>
@endsection
