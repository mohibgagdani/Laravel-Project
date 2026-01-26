<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $query = Book::with(['author', 'category'])->where('available_quantity', '>', 0);

        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhereHas('author', fn($q) => $q->where('name', 'like', "%{$search}%"))
                  ->orWhereHas('category', fn($q) => $q->where('name', 'like', "%{$search}%"));
            });
        }

        $books = $query->latest()->paginate(12);
        return view('user.books.index', compact('books'));
    }

    public function issue(Book $book)
    {
        if ($book->available_quantity <= 0) {
            return back()->with('error', 'Book is not available!');
        }

        $existingIssue = BookIssue::where('user_id', auth()->id())
            ->where('book_id', $book->id)
            ->where('status', 'issued')
            ->first();

        if ($existingIssue) {
            return back()->with('error', 'You have already issued this book!');
        }

        BookIssue::create([
            'user_id' => auth()->id(),
            'book_id' => $book->id,
            'issue_date' => now(),
            'status' => 'issued'
        ]);

        $book->decrement('available_quantity');

        return back()->with('success', 'Book issued successfully!');
    }
}
