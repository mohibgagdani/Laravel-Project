@extends('layouts.app')

@section('title', 'Edit Author')
@section('page-title', 'Edit Author')

@section('content')
<div class="form-container">
    <form action="{{ route('admin.authors.update', $author) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" value="{{ old('name', $author->name) }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Bio</label>
            <textarea name="bio" rows="4">{{ old('bio', $author->bio) }}</textarea>
            @error('bio')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Author</button>
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
