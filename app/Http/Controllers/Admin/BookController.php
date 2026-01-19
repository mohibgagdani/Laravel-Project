<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Models\Author;
use App\Models\Category;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'category'])->latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('admin.books.create', compact('authors', 'categories'));
    }

    public function store(BookRequest $request)
    {
        Book::create([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'available_quantity' => $request->quantity,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book created successfully');
    }

    public function edit(Book $book)
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'authors', 'categories'));
    }

    public function update(BookRequest $request, Book $book)
    {
        $diff = $request->quantity - $book->quantity;
        
        $book->update([
            'title' => $request->title,
            'isbn' => $request->isbn,
            'author_id' => $request->author_id,
            'category_id' => $request->category_id,
            'quantity' => $request->quantity,
            'available_quantity' => $book->available_quantity + $diff,
        ]);

        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }
}
