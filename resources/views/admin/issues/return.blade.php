@extends('layouts.app')

@section('title', 'Return Book')
@section('page-title', 'Return Book')

@section('content')
<div class="form-container">
    <div class="info-box">
        <p><strong>User:</strong> {{ $issue->user->name }}</p>
        <p><strong>Book:</strong> {{ $issue->book->title }}</p>
        <p><strong>Issue Date:</strong> {{ $issue->issue_date->format('d M Y') }}</p>
        <p><strong>Due Date:</strong> {{ $issue->due_date->format('d M Y') }}</p>
    </div>
    
    <form action="{{ route('admin.issues.processReturn', $issue) }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Return Date *</label>
            <input type="date" name="return_date" value="{{ old('return_date', date('Y-m-d')) }}" required>
            @error('return_date')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Process Return</button>
            <a href="{{ route('admin.issues.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
