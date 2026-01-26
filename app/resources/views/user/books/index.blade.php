@extends('layouts.app')

@section('title', 'Available Books')
@section('page-title', 'Available Books')

@section('content')
@if(session('success'))
    <div class="alert alert-success auto-hide">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-error auto-hide">{{ session('error') }}</div>
@endif

<div class="search-box">
    <form action="{{ route('user.books.index') }}" method="GET">
        <input type="text" name="search" placeholder="Search by title, author, or category..." value="{{ request('search') }}">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('user.books.index') }}" class="btn btn-secondary">Clear</a>
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
        
        <form id="issue-form-{{ $book->id }}" action="{{ route('user.books.issue', $book) }}" method="POST" style="margin-top: 10px;">
            @csrf
            <button type="button" class="btn btn-primary btn-small" onclick="showIssueModal({{ $book->id }}, '{{ $book->title }}')">
                Issue Book
            </button>
        </form>
    </div>
    @empty
    <p class="text-center">No books found</p>
    @endforelse
</div>

{{ $books->links() }}

<div id="issueModal" class="modal">
    <div class="modal-content">
        <h3>Confirm Book Issue</h3>
        <p id="modalMessage">Are you sure you want to issue this book?</p>
        <div class="modal-buttons">
            <button class="btn btn-primary" onclick="confirmIssue()">Yes, Issue</button>
            <button class="btn btn-secondary" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
let currentBookId = null;

function showIssueModal(bookId, bookTitle) {
    currentBookId = bookId;
    document.getElementById('modalMessage').textContent = `Are you sure you want to issue "${bookTitle}"?`;
    document.getElementById('issueModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('issueModal').style.display = 'none';
    currentBookId = null;
}

function confirmIssue() {
    if (currentBookId) {
        document.getElementById('issue-form-' + currentBookId).submit();
    }
}

window.onclick = function(event) {
    const modal = document.getElementById('issueModal');
    if (event.target == modal) {
        closeModal();
    }
}
</script>
@endsection
