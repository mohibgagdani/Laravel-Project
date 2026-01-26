@extends('layouts.app')

@section('title', 'Users Management')
@section('page-title', 'Users Management')

@section('content')
<div class="page-actions">
    <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Add New User</a>
</div>

@if(session('success'))
    <div class="alert alert-success auto-hide">{{ session('success') }}</div>
@endif

<div class="search-box">
    <form action="{{ route('admin.users.index') }}" method="GET">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search users by name or email...">
        <input type="date" name="start_date" value="{{ request('start_date') }}" placeholder="Start Date">
        <input type="date" name="end_date" value="{{ request('end_date') }}" placeholder="End Date">
        <button type="submit" class="btn btn-primary">Search & Filter</button>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Clear</a>
    </form>
</div>

<div class="data-table">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        <span class="badge {{ $user->role === 'admin' ? 'badge-warning' : 'badge-success' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>
                    <td>{{ $user->created_at->format('M d, Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-small btn-edit">Edit</a>
                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-small btn-delete" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">No users found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection