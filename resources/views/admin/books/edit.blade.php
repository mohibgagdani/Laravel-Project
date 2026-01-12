@extends('layouts.app')

@section('title', 'Edit Book')
@section('page-title', 'Edit Book')

@section('content')
<div class="form-container">
    <form action="{{ route('admin.books.update', $book) }}" method="POST">
        @csrf
        @method('PUT')
        
        <div class="form-group">
            <label>Title *</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
            @error('title')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>ISBN *</label>
            <input type="text" name="isbn" value="{{ old('isbn', $book->isbn) }}" required>
            @error('isbn')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Author *</label>
            <select name="author_id" required>
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Category *</label>
            <select name="category_id" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $book->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-group">
            <label>Quantity *</label>
            <input type="number" name="quantity" value="{{ old('quantity', $book->quantity) }}" min="1" required>
            @error('quantity')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">Update Book</button>
            <a href="{{ route('admin.books.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
