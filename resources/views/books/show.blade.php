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

    <div class="mt-4 flex flex-col bg-gray-100 py-2 px-4 rounded-lg">
        <div>
            <p class="font-semibold text-2xl">📖 Book Reviews</p>
        </div>
        <div class="flex flex-row mt-2">
            <div class="mr-5 self-center">
                <p class="font-bold text-xl">{{ round($avg_rating, 2) }}</p>
            </div>
            <div class="flex flex-col">
                <div>stars</div>
                <div>Based on <strong>{{ count($reviews) }}</strong> ratings</div>
            </div>
        </div>
    </div>

    <div class="max-h-min mt-4">
        <hr>
        @forelse ($reviews as $review)
            <div>
                <div class="mt-3 flex justify-end">
                    <p class="mr-2">{{ $review->rating }} {{ Str::plural('star', $review->rating) }}</p>
                    •
                    <p class="ml-2 book-isbn">posted {{ $review->created_at->diffForHumans() }}</p>
                </div>
                <div>
                    <p class="my-2">{{ $review->comment }}</p>
                </div>
            </div>
            <hr>
        @empty
            <p>There are no reviews for this book. Let's add one!</p>
        @endforelse
        <hr class="mb-10">
    </div>

    <div class="mb-20">
        {{ $reviews->links() }}
    </div>
    <a class="primary-btn fixed bottom-5 right-5">+ Add Review For this Book</a>
@endsection
