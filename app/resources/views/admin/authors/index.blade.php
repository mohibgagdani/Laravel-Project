@extends('layouts.app')

@section('title', 'Authors')
@section('page-title', 'Manage Authors')

@section('content')
<div class="page-actions">
    <a href="{{ route('admin.authors.create') }}" class="btn btn-primary">Add New Author</a>
</div>

<div class="search-box">
    <form action="{{ route('admin.authors.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search authors by name or bio...">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Clear</a>
    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Bio</th>
            <th>Books Count</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($authors as $author)
        <tr>
            <td>{{ $author->name }}</td>
            <td>{{ Str::limit($author->bio, 50) }}</td>
            <td>{{ $author->books_count }}</td>
            <td class="actions">
                <a href="{{ route('admin.authors.edit', $author) }}" class="btn-small btn-edit">Edit</a>
                <form action="{{ route('admin.authors.destroy', $author) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-small btn-delete" onclick="return confirm('Delete this author?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No authors found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $authors->links() }}
@endsection
