<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\BookIssue;
use Illuminate\Http\Request;

class IssueController extends Controller
{
    public function index(Request $request)
    {
        $query = auth()->user()->bookIssues()->with(['book.author']);
        
        if ($request->start_date && $request->end_date) {
            $query->whereBetween('issue_date', [$request->start_date, $request->end_date]);
        }
        
        $issues = $query->latest()->get();
        return view('user.issues.index', compact('issues'));
    }

    public function return(BookIssue $issue)
    {
        if ($issue->user_id !== auth()->id()) {
            return back()->with('error', 'Unauthorized action!');
        }

        if ($issue->status === 'returned') {
            return back()->with('error', 'Book already returned!');
        }

        $issue->update([
            'return_date' => now(),
            'status' => 'returned'
        ]);
        
        $issue->book->increment('available_quantity');

        return back()->with('success', 'Book returned successfully!');
    }
}
