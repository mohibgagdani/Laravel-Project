@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="auth-container">
    <div>
        <h1 class="auth-title">Library Management System</h1>
        <div class="auth-box">
            <h2>Reset Password</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        
        <form action="{{ route('forgot.password.update') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" required>
                @error('password_confirmation')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Reset Password</button>
        </form>
        
        <p class="auth-link"><a href="{{ route('login') }}">Back to Login</a></p>
        </div>
    </div>
</div>
@endsection