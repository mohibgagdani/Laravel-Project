<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\BookIssue;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_books' => Book::sum('quantity'),
            'issued_books' => BookIssue::where('status', 'issued')->count(),
            'returned_books' => BookIssue::where('status', 'returned')->count(),
            'total_users' => User::where('role', 'user')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
