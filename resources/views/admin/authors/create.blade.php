@extends('layouts.app')

@section('title', 'Add Author')
@section('page-title', 'Add New Author')

@section('content')
<div class="form-container">
    <form action="{{ route('admin.authors.store') }}" method="POST">
        @csrf
        
        <div class="form-group">
            <label>Name *</label>
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Bio</label>
            <textarea name="bio" rows="4">{{ old('bio') }}</textarea>
            @error('bio')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Create Author</button>
            <a href="{{ route('admin.authors.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
