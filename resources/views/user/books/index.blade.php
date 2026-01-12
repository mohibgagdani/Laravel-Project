@extends('layouts.app')

@section('title', 'Available Books')
@section('page-title', 'Available Books')

@section('content')
<div class="search-box">
    <form action="{{ route('user.books.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search by title, author, or category..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
</div>

<div class="books-grid">
    @forelse($books as $book)
    <div class="book-card">
        <h3>{{ $book->title }}</h3>
        <p class="book-author">by {{ $book->author->name }}</p>
        <p class="book-category">{{ $book->category->name }}</p>
        <p class="book-isbn">ISBN: {{ $book->isbn }}</p>
        <p class="book-available">Available: {{ $book->available_quantity }}</p>
    </div>
    @empty
    <p class="text-center">No books found</p>
    @endforelse
</div>

{{ $books->links() }}
@endsection
