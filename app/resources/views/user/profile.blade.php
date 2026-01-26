@extends('layouts.app')

@section('title', 'Profile')
@section('page-title', 'My Profile')

@section('content')
<div class="profile-container">
    <div class="profile-card">
        <h3>Profile Information</h3>
        <div class="profile-info">
            <p><strong>Name:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
            <p><strong>Member Since:</strong> {{ $user->created_at->format('d M Y') }}</p>
        </div>
    </div>
    
    <div class="profile-card">
        <h3>Reading Statistics</h3>
        <div class="profile-stats">
            <p><strong>Currently Issued:</strong> {{ $user->bookIssues()->where('status', 'issued')->count() }}</p>
            <p><strong>Total Books Read:</strong> {{ $user->bookIssues()->where('status', 'returned')->count() }}</p>
        </div>
    </div>
</div>
@endsection
