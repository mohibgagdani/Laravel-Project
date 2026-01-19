<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class IssueController extends Controller
{
    public function index()
    {
        $issues = auth()->user()->bookIssues()->with('book')->latest()->paginate(10);
        return view('user.issues.index', compact('issues'));
    }
}
