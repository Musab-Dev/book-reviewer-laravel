<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Book $book)
    {
        return view('books.reviews.create', compact('book'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Book $book)
    {
        /* Rate Limiting - Limit Number of calls to this action during specific amount of time */
        $executed = RateLimiter::attempt(
            'review_'. $request->ip(),
            $maxAttempts = 5,
            function() use ($request, $book){
                $data = $request->validate([
                    'comment' => 'required',
                    'rating' => 'required|min:1|max:5|integer',
                ]);
                $book->reviews()->create($data);
            },
            $decaySeconds = 3600, /*time to reset the attempts count */
        );
        
        if ($executed){
            return redirect()->route('books.show', compact('book'));
        }
        else{
            return 'Too Many Request Sent! try  again after one hour.';
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book, Review $review)
    {
        return view('books.reviews.edit', compact('book', 'review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book, Review $review)
    {
        $data = $request->validate([
            'comment' => 'required',
            'rating' => 'required|min:1|max:5|integer',
        ]);

        $review->update($data);
        return redirect()->route('books.show', compact('book'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book, Review $review)
    {
        // $review->delete();
        Review::destroy($review->id);
        return redirect()->route('books.show', compact('book'));
    }
}
