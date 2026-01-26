@extends('layouts.app')

@section('title', 'Categories')
@section('page-title', 'Manage Categories')

@section('content')
<div class="page-actions">
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">Add New Category</a>
</div>

<div class="search-box">
    <form action="{{ route('admin.categories.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search categories by name or description...">
        <button type="submit" class="btn btn-primary">Search</button>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Clear</a>
    </form>
</div>

<table class="data-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Description</th>
            <th>Books Count</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($categories as $category)
        <tr>
            <td>{{ $category->name }}</td>
            <td>{{ Str::limit($category->description, 50) }}</td>
            <td>{{ $category->books_count }}</td>
            <td class="actions">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn-small btn-edit">Edit</a>
                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-small btn-delete" onclick="return confirm('Delete this category?')">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">No categories found</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $categories->links() }}
@endsection
