<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = Book::paginate(10);

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
        $reviews = $book->reviews;
        
        return view('books.show', ['book'=> $book,  'reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
