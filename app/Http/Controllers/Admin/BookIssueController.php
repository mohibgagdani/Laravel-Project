<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\IssueBookRequest;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\User;
use Illuminate\Http\Request;

class BookIssueController extends Controller
{
    public function index()
    {
        $issues = BookIssue::with(['user', 'book'])->latest()->paginate(10);
        return view('admin.issues.index', compact('issues'));
    }

    public function create()
    {
        $users = User::where('role', 'user')->get();
        $books = Book::where('available_quantity', '>', 0)->get();
        return view('admin.issues.create', compact('users', 'books'));
    }

    public function store(IssueBookRequest $request)
    {
        $book = Book::findOrFail($request->book_id);
        
        if ($book->available_quantity < 1) {
            return back()->withErrors(['book_id' => 'Book not available'])->withInput();
        }

        BookIssue::create($request->validated());
        
        $book->decrement('available_quantity');

        return redirect()->route('admin.issues.index')->with('success', 'Book issued successfully');
    }

    public function returnBook(BookIssue $issue)
    {
        return view('admin.issues.return', compact('issue'));
    }

    public function processReturn(Request $request, BookIssue $issue)
    {
        $request->validate([
            'return_date' => 'required|date',
        ]);

        $issue->update([
            'return_date' => $request->return_date,
            'status' => 'returned',
            'fine' => $issue->calculateFine(),
        ]);

        $issue->book->increment('available_quantity');

        return redirect()->route('admin.issues.index')->with('success', 'Book returned successfully');
    }
}
