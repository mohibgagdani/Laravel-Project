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
    public function index(Request $request)
    {
        $query = BookIssue::with(['user', 'book']);
        
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('issue_date', [$request->start_date, $request->end_date]);
        }
        
        $issues = $query->latest()->paginate(10);
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
        $user = User::where('name', $request->user_name)->first();
        $book = Book::where('title', $request->book_title)->first();
        
        if ($book->available_quantity < 1) {
            return back()->withErrors(['book_title' => 'Book not available'])->withInput();
        }

        BookIssue::create([
            'user_id' => $user->id,
            'book_id' => $book->id,
            'issue_date' => $request->issue_date,
            'status' => 'issued'
        ]);
        
        $book->decrement('available_quantity');

        return redirect()->route('admin.issues.index')->with('success', 'Book issued successfully');
    }

    

    public function processReturn(Request $request, BookIssue $issue)
    {
        $request->validate([
            'return_date' => 'required|date',
        ]);

        $issue->update([
            'return_date' => $request->return_date,
            'status' => 'returned',
        ]);

        $issue->book->increment('available_quantity');

        return redirect()->route('admin.issues.index')->with('success', 'Book returned successfully');
    }
}
