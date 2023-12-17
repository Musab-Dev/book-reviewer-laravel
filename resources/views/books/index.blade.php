@extends('layouts.app')

@section('page-actions')
    <a class="page-action-link" href="{{ route('books.create') }}">+ Add New Book</a>
@endsection

@section('title', 'All Books!')

@section('content')

    <form method="GET" action="{{ route('books.index') }}" class="mb-6">
        <div class="flex flex-row gap-2 justify-stretch">
            <input type="text" class="form-input flex-grow" name="title" placeholder="search by book title..."
                value="{{ request('title') }}" required />
            <button type="submit" class="primary-btn">Filter</button>
            <a class="secondary-btn" href="{{ route('books.index') }}">Clear</a>
        </div>
    </form>

    @forelse ($books as $book)
        <a href="{{ route('books.show', ['book' => $book]) }}">
            <div class="relative book-card flex">
                <div>
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
                <div class="absolute right-5">
                    REVIEWS
                </div>
            </div>
        </a>
    @empty
        <div>there are no books yet! Try Add One</div>
    @endforelse

    <div class="my-4">
        {{ $books->links() }}
    </div>
@endsection
