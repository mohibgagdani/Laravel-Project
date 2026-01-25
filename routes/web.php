<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookIssueController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\IssueController as UserIssueController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('books', AdminBookController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);
    
    Route::get('/issues', [BookIssueController::class, 'index'])->name('issues.index');
    Route::get('/issues/create', [BookIssueController::class, 'create'])->name('issues.create');
    Route::post('/issues', [BookIssueController::class, 'store'])->name('issues.store');
    Route::get('/issues/{issue}/return', [BookIssueController::class, 'returnBook'])->name('issues.return');
    Route::post('/issues/{issue}/return', [BookIssueController::class, 'processReturn'])->name('issues.processReturn');
});

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/books', [UserBookController::class, 'index'])->name('books.index');
    Route::get('/issues', [UserIssueController::class, 'index'])->name('issues.index');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
