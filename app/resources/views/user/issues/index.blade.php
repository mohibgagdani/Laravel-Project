@extends('layouts.app')

@section('title', 'My Issued Books')
@section('page-title', 'My Issued Books')

@section('content')
@if(session('success'))
    <div class="alert alert-success auto-hide">{{ session('success') }}</div>
@endif

@if(session('error'))
    <div class="alert alert-error auto-hide">{{ session('error') }}</div>
@endif

<div class="search-box">
    <form action="{{ route('user.issues.index') }}" method="GET">
        <input type="date" name="start_date" value="{{ request('start_date') }}" placeholder="Start Date">
        <input type="date" name="end_date" value="{{ request('end_date') }}" placeholder="End Date">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('user.issues.index') }}" class="btn btn-secondary">Clear</a>
    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Book</th>
            <th>Author</th>
            <th>Issued Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($issues as $issue)
        <tr>
            <td>{{ $issue->book->title }}</td>
            <td>{{ $issue->book->author->name }}</td>
            <td>{{ $issue->issue_date->format('d M Y') }}</td>
            <td>
                @if($issue->status === 'returned')
                    <span class="badge badge-success">Returned</span>
                @else
                    <span class="badge badge-warning">Issued</span>
                @endif
            </td>
            <td>
                @if($issue->status === 'issued')
                    <button type="button" class="btn btn-small btn-primary" 
                        onclick="showReturnModal({{ $issue->id }}, '{{ $issue->book->title }}')">
                        Return Book
                    </button>
                    <form id="return-form-{{ $issue->id }}" action="{{ route('user.issues.return', $issue) }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <span>Returned on {{ $issue->return_date ? $issue->return_date->format('d M Y') : '-' }}</span>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="text-center">No issued books</td>
        </tr>
        @endforelse
    </tbody>
</table>

<!-- Return Book Modal -->
<div id="returnModal" class="modal">
    <div class="modal-content">
        <h3>Return Book</h3>
        <p id="modalMessage">Are you sure you want to return this book?</p>
        <div class="modal-buttons">
            <button type="button" class="btn btn-primary" onclick="confirmReturn()">Yes, Return</button>
            <button type="button" class="btn btn-secondary" onclick="closeModal()">Cancel</button>
        </div>
    </div>
</div>

<script>
let currentIssueId = null;

function showReturnModal(issueId, bookTitle) {
    currentIssueId = issueId;
    document.getElementById('modalMessage').textContent = `Are you sure you want to return "${bookTitle}"?`;
    document.getElementById('returnModal').style.display = 'block';
}

function confirmReturn() {
    if (currentIssueId) {
        document.getElementById(`return-form-${currentIssueId}`).submit();
    }
}

function closeModal() {
    document.getElementById('returnModal').style.display = 'none';
    currentIssueId = null;
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('returnModal');
    if (event.target === modal) {
        closeModal();
    }
}
</script>
@endsection
