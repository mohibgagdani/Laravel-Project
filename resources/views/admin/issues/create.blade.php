@extends('layouts.app')

@section('title', 'Issue Book')
@section('page-title', 'Issue New Book')

@section('content')
<div class="form-container">
    <form action="{{ route('admin.issues.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>User *</label>
            <select name="user_id" required>
                <option value="">Select User</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Book *</label>
            <select name="book_id" required>
                <option value="">Select Book</option>
                @foreach($books as $book)
                    <option value="{{ $book->id }}" {{ old('book_id') == $book->id ? 'selected' : '' }}>
                        {{ $book->title }} (Available: {{ $book->available_quantity }})
                    </option>
                @endforeach
            </select>
            @error('book_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Issue Date *</label>
            <input type="date" name="issue_date" value="{{ old('issue_date', date('Y-m-d')) }}" required>
            @error('issue_date')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Due Date *</label>
            <input type="date" name="due_date" value="{{ old('due_date', date('Y-m-d', strtotime('+14 days'))) }}" required>
            @error('due_date')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Issue Book</button>
            <a href="{{ route('admin.issues.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
