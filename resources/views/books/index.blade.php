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
            <input type="hidden" name="filter" value="{{ request('filter') }}" />
            <button type="submit" class="primary-btn">Filter</button>
            <a class="secondary-btn" href="{{ route('books.index') }}">Clear</a>
        </div>
    </form>

    <div class="bg-gray-100 flex mb-4 items-center place-content-between">
        @php
            $filters = [
                'latest' => 'Latest Books',
                'popular_last_month' => 'Popular Books Last Month',
                'popular_last_6_months' => 'Popular Books Last 6 Months',
                'highest_rated_last_month' => 'Highest Rated Books Last Month',
                'highest_rated_last_6_months' => 'Hightest Rated Books Last 6 Months',
            ];
        @endphp
        @foreach ($filters as $key => $filter)
            <a href="{{ route('books.index', [...request()->query(), 'filter' => $key]) }}"
                class="{{ request('filter') === $key || (request('filter') == null && $key == 'latest') ? 'filter-item-active' : 'filter-item' }}">
                <p>{{ $filter }}</p>
            </a>
        @endforeach
    </div>

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
                <div class="absolute right-5 flex flex-col">
                    <div>
                        {{ round($book->reviews_avg_rating, 2) }}
                    </div>
                    <div>
                        out of {{ $book->reviews_count }} {{ Str::plural('review', $book->reviews_count) }}
                    </div>
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
