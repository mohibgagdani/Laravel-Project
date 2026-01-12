<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Library Management</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    @auth
    <div class="layout">
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Library System</h2>
            </div>
            <nav class="sidebar-nav">
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                    <a href="{{ route('admin.books.index') }}" class="{{ request()->routeIs('admin.books.*') ? 'active' : '' }}">Books</a>
                    <a href="{{ route('admin.authors.index') }}" class="{{ request()->routeIs('admin.authors.*') ? 'active' : '' }}">Authors</a>
                    <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">Categories</a>
                    <a href="{{ route('admin.issues.index') }}" class="{{ request()->routeIs('admin.issues.*') ? 'active' : '' }}">Issue/Return</a>
                @else
                    <a href="{{ route('user.books.index') }}" class="{{ request()->routeIs('user.books.*') ? 'active' : '' }}">Available Books</a>
                    <a href="{{ route('user.issues.index') }}" class="{{ request()->routeIs('user.issues.*') ? 'active' : '' }}">My Issued Books</a>
                    <a href="{{ route('user.profile') }}" class="{{ request()->routeIs('user.profile') ? 'active' : '' }}">Profile</a>
                @endif
            </nav>
        </aside>
        
        <div class="main-content">
            <header class="header">
                <div class="header-left">
                    <h1>@yield('page-title')</h1>
                </div>
                <div class="header-right">
                    <span>{{ auth()->user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn-logout">Logout</button>
                    </form>
                </div>
            </header>
            
            <div class="content">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                
                @if(session('error'))
                    <div class="alert alert-error">{{ session('error') }}</div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
    @else
        @yield('content')
    @endauth
</body>
</html>
