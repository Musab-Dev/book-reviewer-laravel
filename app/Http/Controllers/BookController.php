<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = $request->input('title');
        $filter = $request->input('filter', 'latest');

        $books = Book::when($title, function (Builder $query) use ($title) {
            $query->title($title);
        });

        $books = match ($filter) {
            'popular_last_month' => $books->popularLastMonth(),
            'popular_last_6_months' => $books->popularLast6Months(),
            'highest_rated_last_month' => $books->highestRatedLastMonth(),
            'highest_rated_last_6_months' => $books->highestRatedLast6Months(),
            default => $books->withCount('reviews')->withAvg('reviews', 'rating')->latest(),
        };
        
        $cacheKey = 'books_' . $title . '_' . $filter;
        $books = cache()->remember($cacheKey, 3600, fn() => $books->paginate(10));

        return view('books.index', ['books'=> $books]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('books.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'isbn' => 'required|alpha_num|unique:books,isbn',
            'title' => 'required|unique:books,title',
            'author' => 'required',
        ]);

        $book = Book::create($data);

        return redirect()->route('books.show', ['book' => $book])->with('success','Book Added Successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // $reviews = Book::findOrFail($book->id)->with(['reviews' => function (Builder $query) {
        //     $query->orderBy('created_at', 'desc');
        // }])->reviews;
        $reviews = Review::where('book_id', $book->id)->orderBy('created_at','desc');
        $avg_rating = $reviews->avg('rating');

        return view('books.show', ['book'=> $book,  'reviews' => $reviews->paginate(10), 'avg_rating' => $avg_rating]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        return view('books.edit', ['book'=> $book]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'isbn' => 'required|alpha_num|unique:books,isbn,'. $book->id,
            'title' => 'required|unique:books,title,' . $book->id,
            'author' => 'required',
        ]);
        $book->update($data);

        return redirect()->route('books.show', ['book' => $book])->with('success','book info updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book->delete();
        // Book::destroy($book->id);
        return redirect()->route('books.index')->with('success','book deleted successfully!');
    }
}
