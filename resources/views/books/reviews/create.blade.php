@extends('layouts.app')

@php
    $pageTitle = 'Add Book Review';
@endphp


@section('page-actions')
    <a class="page-action-link" href="{{ route('books.show', compact('book')) }}">← Back</a>
@endsection

@section('title', 'Add Review: ' . $book->title)

@section('content')
    <form method="post" action="{{ route('books.reviews.store', compact('book')) }}">
        @csrf
        <div class="flex flex-col gap-y-2 mb-3">
            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" class="form-input">{{ old('comment') }}</textarea>
            @error('comment')
                <div>
                    <p class="error-message">{{ $message }}</p>
                </div>
            @enderror
        </div>
        <div class="flex flex-col gap-y-2 mb-3">
            <label for="rating">Rating</label>
            <select name="rating" id="rating" class="form-input">
                <option value="">select a rating</option>
                @for ($i = 1; $i <= 5; $i++)
                    <option value="{{ $i }}">{{ $i }}</option>
                @endfor
            </select>
            @error('rating')
                <div>
                    <p class="error-message">{{ $message }}</p>
                </div>
            @enderror
        </div>
        <div>
            <button type="submit" class="primary-btn">Save Review</button>
        </div>
    </form>
@endsection
