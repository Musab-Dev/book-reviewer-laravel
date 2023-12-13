@extends('layouts.app')

@section('title', 'All Books!')

@section('content')

    @forelse ($books as $book)
        <div>{{ $book->title }}</div>
    @empty
        <div>there are no books yet! Try Add One</div>
    @endforelse

@endsection
