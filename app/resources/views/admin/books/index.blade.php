@extends('layouts.app')

@section('title', 'Books')
@section('page-title', 'Manage Books')

@section('content')
<div class="page-actions">
    <a href="{{ route('admin.books.create') }}" class="btn btn-primary">Add New Book</a>
</div>

<div class="search-box">
    <form action="{{ route('admin.books.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search books by title, ISBN, author, or category...">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Clear</a>
    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Title</th>
            <th>ISBN</th>
            <th>Author</th>
            <th>Category</th>
            <th>Quantity</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($books as $book)
        <tr>
            <td>{{ $book->title }}</td>
            <td>{{ $book->isbn }}</td>
            <td>{{ $book->author->name }}</td>
            <td>{{ $book->category->name }}</td>
            <td>{{ $book->quantity }}</td>
            <td>{{ $book->available_quantity }}</td>
            <td class="actions">
                <a href="{{ route('admin.books.edit', $book) }}" class="btn-small btn-edit">Edit</a>
                <form action="{{ route('admin.books.destroy', $book) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-small btn-delete" onclick="return confirm('Delete this book?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">No books found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $books->links() }}
@endsection
