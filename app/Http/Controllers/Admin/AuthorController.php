<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('books')->latest()->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    public function create()
    {
        return view('admin.authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        Author::create($request->all());
        return redirect()->route('admin.authors.index')->with('success', 'Author created successfully');
    }

    public function edit(Author $author)
    {
        return view('admin.authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'nullable|string',
        ]);

        $author->update($request->all());
        return redirect()->route('admin.authors.index')->with('success', 'Author updated successfully');
    }

    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('admin.authors.index')->with('success', 'Author deleted successfully');
    }
}
