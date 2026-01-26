@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="auth-container">
    <div>
        <h1 class="auth-title">Library Management System</h1>
        <div class="auth-box">
            <h2>Login to Library</h2>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
        
        <p class="auth-link"><a href="{{ route('forgot.password') }}">Forgot Password?</a></p>
        <p class="auth-link">Don't have an account? <a href="{{ route('register') }}">Register here</a></p>
        </div>
    </div>
</div>
@endsection
