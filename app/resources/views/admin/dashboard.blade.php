@extends('layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Admin Dashboard')

@section('content')
<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Books</h3>
        <p class="stat-number">{{ $stats['total_books'] }}</p>
    </div>
    
    <div class="stat-card">
        <h3>Issued Books</h3>
        <p class="stat-number">{{ $stats['issued_books'] }}</p>
    </div>
    
    <div class="stat-card">
        <h3>Returned Books</h3>
        <p class="stat-number">{{ $stats['returned_books'] }}</p>
    </div>
    
    <div class="stat-card">
        <h3>Total Users</h3>
        <p class="stat-number">{{ $stats['total_users'] }}</p>
    </div>
</div>
@endsection
