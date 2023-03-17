<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // get all the books borrowed by every user

        $books = Book::withCount('borrowers')->get();
        foreach ($books as $book) {
            // count the book borrowers and update the quantity of available books
            $book->quantity = $book->quantity - $book->borrowers_count;
        }
        return response()->json($books, 200);
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
        // for this example we will not do any verification of the data from the user
        // in a real one we should check the user input preferably on a new Laravel Form Request

        // just for design purposes we will put a random image as the book cover
        $images = ['/src/assets/images/book_covers/harry.jpg', '/src/assets/images/book_covers/killer.jpg','/src/assets/images/book_covers/lifeofpi.jpg', '/src/assets/images/book_covers/martian.jpg','/src/assets/images/book_covers/martin.jpg', '/src/assets/images/book_covers/potter.jpg','/src/assets/images/book_covers/roald.jpg'];
        shuffle($images);
        $newBook = Book::create([
            'cover' => $images[0], // we also do not save any picture as this is an example, if it were a real one it will be a good ideea to store the picture on an external storage FTP
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);
        return response()->json($newBook, 200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Book $book)
    {
        // for this example this is not used
        $book = Book::findOrFail($book->id);
        return response()->json($book, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Book $book)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Book $book)
    {
        $book = Book::find($book->id);
        $book->update([
            'cover' => $request->cover, // we also do not save any picture as this is an example, if it were a real one it will be a good ideea to store the picture on an external storage FTP
            'name' => $request->name,
            'quantity' => $request->quantity,
        ]);
        return response()->json($book, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Book $book)
    {
        $book = Book::find($book->id);
        $book->delete();
        return response()->json($book->id, 200);
    }
}
