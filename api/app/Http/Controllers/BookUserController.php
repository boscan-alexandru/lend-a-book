<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\BookUser;
use App\Models\User;
use Illuminate\Http\Request;

class BookUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(User $user)
    {
        // Get all the borrowed books by user
        $userBorrowedBooks = User::where([['id', $user->id], ['role', 'client']])->with('books')->first();
        return response()->json($userBorrowedBooks->books, 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // check if user already has a copy of the book
        // get my books
        $my_books = User::with([
            'books' => function($book){
                $book->select('user_id');
            }
        ])
        ->where([['id', $request->user_id], ['role', 'client']])
        ->first();
        foreach ($my_books->books as $book) {
            if($book->pivot->book_id == $request->book_id){
                return response()->json('You already have a copy of this book!', 400);
            }
        }
        // get the non admin user
        $client = User::where([['role', 'client'], ['id', $request->user_id]])->first();
        $book = Book::find($request->book_id);
        $client->books()->attach($book);

        return response()->json($client, 200);
    }

    /**
     * Display the specified resource.
     */
    public function getBorrowedBooks()
    {
        // get all the books that were borrowed and by who
        $books = Book::with([
            'borrowers' => function($borrower){
                $borrower->select('user_id', 'name');
            }
        ])
        ->has('borrowers')
        ->get();
        foreach ($books as $book) {
            foreach ($book->borrowers as $borrower) {
                unset($borrower->pivot);
            }
            unset($book->created_at);
            unset($book->updated_at);
            unset($book->quantity);
        }

        return response()->json($books, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BookUser $bookUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BookUser $bookUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $client = User::where([['id', $request->user_id], ['role', 'client']])->first();
        $client->books()->detach($request->book_id);

        return response()->json($request->book_id, 200);
    }
}
