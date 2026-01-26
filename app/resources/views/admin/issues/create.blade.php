@extends('layouts.app')

@section('title', 'Issue Book')
@section('page-title', 'Issue New Book')

@section('content')
<div class="form-container">
    <form action="{{ route('admin.issues.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>User *</label>
            <input list="users" name="user_name" placeholder="Type or select user..." required>
            <datalist id="users">
                @foreach($users as $user)
                    <option value="{{ $user->name }}">{{ $user->email }}</option>
                @endforeach
            </datalist>
            @error('user_name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Book *</label>
            <input list="books" name="book_title" placeholder="Type or select book..." required>
            <datalist id="books">
                @foreach($books as $book)
                    <option value="{{ $book->title }}">Available: {{ $book->available_quantity }}</option>
                @endforeach
            </datalist>
            @error('book_title')
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
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Issue Book</button>
            <a href="{{ route('admin.issues.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
