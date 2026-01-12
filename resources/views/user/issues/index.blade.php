@extends('layouts.app')

@section('title', 'My Issued Books')
@section('page-title', 'My Issued Books')

@section('content')
<table class="data-table">
    <thead>
        <tr>
            <th>Book</th>
            <th>Issue Date</th>
            <th>Due Date</th>
            <th>Return Date</th>
            <th>Fine (₹)</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($issues as $issue)
        <tr>
            <td>{{ $issue->book->title }}</td>
            <td>{{ $issue->issue_date->format('d M Y') }}</td>
            <td>{{ $issue->due_date->format('d M Y') }}</td>
            <td>{{ $issue->return_date ? $issue->return_date->format('d M Y') : '-' }}</td>
            <td>{{ $issue->status === 'issued' ? $issue->calculateFine() : $issue->fine }}</td>
            <td>
                <span class="badge badge-{{ $issue->status === 'issued' ? 'warning' : 'success' }}">
                    {{ ucfirst($issue->status) }}
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No issued books</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $issues->links() }}
@endsection
