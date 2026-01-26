<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create Regular Users
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // Create Authors
        $authors = [
            ['name' => 'J.K. Rowling', 'bio' => 'British author, best known for Harry Potter series'],
            ['name' => 'George Orwell', 'bio' => 'English novelist and essayist'],
            ['name' => 'Jane Austen', 'bio' => 'English novelist known for romantic fiction'],
            ['name' => 'Mark Twain', 'bio' => 'American writer and humorist'],
            ['name' => 'Agatha Christie', 'bio' => 'English writer known for detective novels'],
        ];

        foreach ($authors as $author) {
            Author::create($author);
        }

        // Create Categories
        $categories = [
            ['name' => 'Fiction', 'description' => 'Fictional literature'],
            ['name' => 'Mystery', 'description' => 'Mystery and thriller books'],
            ['name' => 'Classic', 'description' => 'Classic literature'],
            ['name' => 'Fantasy', 'description' => 'Fantasy and magical books'],
            ['name' => 'Adventure', 'description' => 'Adventure stories'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Books
        $books = [
            ['title' => 'Harry Potter and the Philosopher\'s Stone', 'isbn' => '9780747532699', 'author_id' => 1, 'category_id' => 4, 'quantity' => 5],
            ['title' => '1984', 'isbn' => '9780451524935', 'author_id' => 2, 'category_id' => 1, 'quantity' => 3],
            ['title' => 'Animal Farm', 'isbn' => '9780451526342', 'author_id' => 2, 'category_id' => 3, 'quantity' => 4],
            ['title' => 'Pride and Prejudice', 'isbn' => '9780141439518', 'author_id' => 3, 'category_id' => 3, 'quantity' => 6],
            ['title' => 'The Adventures of Tom Sawyer', 'isbn' => '9780143107330', 'author_id' => 4, 'category_id' => 5, 'quantity' => 4],
            ['title' => 'Murder on the Orient Express', 'isbn' => '9780062693662', 'author_id' => 5, 'category_id' => 2, 'quantity' => 5],
            ['title' => 'And Then There Were None', 'isbn' => '9780062073488', 'author_id' => 5, 'category_id' => 2, 'quantity' => 3],
        ];

        foreach ($books as $book) {
            Book::create([
                'title' => $book['title'],
                'isbn' => $book['isbn'],
                'author_id' => $book['author_id'],
                'category_id' => $book['category_id'],
                'quantity' => $book['quantity'],
                'available_quantity' => $book['quantity'],
            ]);
        }
    }
}
