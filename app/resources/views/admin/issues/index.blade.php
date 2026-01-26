@extends('layouts.app')

@section('title', 'Book Issues')
@section('page-title', 'Manage Book Issues')

@section('content')
<div class="page-actions">
    <a href="{{ route('admin.issues.create') }}" class="btn btn-primary">Issue New Book</a>
</div>

<div class="search-box">
    <form action="{{ route('admin.issues.index') }}" method="GET">
        <input type="date" name="start_date" value="{{ request('start_date') }}" placeholder="Start Date">
        <input type="date" name="end_date" value="{{ request('end_date') }}" placeholder="End Date">
        <button type="submit" class="btn btn-primary">Filter</button>
        <a href="{{ route('admin.issues.index') }}" class="btn btn-secondary">Clear</a>
    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>User</th>
            <th>Book</th>
            <th>Issue Date</th>
            <th>Return Date</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($issues as $issue)
        <tr>
            <td>{{ $issue->user->name }}</td>
            <td>{{ $issue->book->title }}</td>
            <td>{{ $issue->issue_date->format('d M Y') }}</td>
            <td>{{ $issue->return_date ? $issue->return_date->format('d M Y') : '-' }}</td>
            <td>
                <span class="badge badge-{{ $issue->status === 'issued' ? 'warning' : 'success' }}">
                    {{ ucfirst($issue->status) }}
                </span>
            </td>
            <td class="actions">
                @if($issue->status === 'issued')
                    <a href="{{ route('admin.issues.return', $issue) }}" class="btn-small btn-primary">Return</a>
                @endif
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No issues found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $issues->links() }}
@endsection
