<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BookController as AdminBookController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\BookIssueController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\User\BookController as UserBookController;
use App\Http\Controllers\User\IssueController as UserIssueController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => redirect('/login'));
Route::get('/test', [TestController::class, 'test']);

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot.password');
Route::post('/forgot-password', [AuthController::class, 'updateForgotPassword'])->name('forgot.password.update');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    Route::resource('books', AdminBookController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('users', UserController::class);
    
    Route::get('/issues', [BookIssueController::class, 'index'])->name('issues.index');
    Route::get('/issues/create', [BookIssueController::class, 'create'])->name('issues.create');
    Route::post('/issues', [BookIssueController::class, 'store'])->name('issues.store');
    Route::get('/issues/{issue}/return', [BookIssueController::class, 'returnBook'])->name('issues.return');
    Route::post('/issues/{issue}/return', [BookIssueController::class, 'processReturn'])->name('issues.processReturn');
});

// User Routes
Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/books', [UserBookController::class, 'index'])->name('books.index');
    Route::post('/books/{book}/issue', [UserBookController::class, 'issue'])->name('books.issue');
    Route::get('/issues', [UserIssueController::class, 'index'])->name('issues.index');
    Route::post('/issues/{issue}/return', [UserIssueController::class, 'return'])->name('issues.return');
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
