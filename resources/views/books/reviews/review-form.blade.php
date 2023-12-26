@extends('layouts.app')

@section('page-actions')
    <a class="page-action-link" href="{{ route('books.show', compact('book')) }}">
        ← Back
    </a>
@endsection

@section('title', isset($review) ? 'Edit Review for "' . $book->title . '"' : 'Add New Review for "' . $book->title .
    '"')

@section('content')
    <form method="post"
        action="{{ isset($review)
            ? route('books.reviews.update', compact('book', 'review'))
            : route('books.reviews.store', compact('book')) }}">
        @csrf
        @if (isset($review))
            @method('put')
        @endif
        <div class="flex flex-col gap-y-2 mb-3">
            <label for="comment">Comment</label>
            <textarea name="comment" id="comment" class="form-input">{{ $review->comment ?? old('comment') }}</textarea>
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
                    @if (old('rating') == $i || (isset($review) && $review->rating == $i))
                        <option value="{{ $i }}" selected>{{ $i }}</option>
                    @else
                        <option value="{{ $i }}">{{ $i }}</option>
                    @endif
                @endfor
            </select>
            @error('rating')
                <div>
                    <p class="error-message">{{ $message }}</p>
                </div>
            @enderror
        </div>
        <div>
            <button type="submit" class="primary-btn">
                @isset($review)
                    Save Changes
                @else
                    Save Review
                @endisset
            </button>
        </div>
    </form>
@endsection
