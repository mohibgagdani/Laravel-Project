# Library Management System - Setup Guide

## Prerequisites
- PHP >= 8.2
- Composer
- MySQL
- Web Server (Apache/Nginx)

## Installation Steps

### 1. Clone/Download Project
Already in: `c:\Marwadi University\SEM 6\Laravel Project\LIBRARY_MANAGEMENT_SYSTEM\laravel`

### 2. Install Dependencies
```bash
composer install
```

### 3. Environment Configuration
Copy `.env.example` to `.env` and configure database:

```env
APP_NAME="Library Management System"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_management
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate Application Key
```bash
php artisan key:generate
```

### 5. Create Database
Create a MySQL database named `library_management`:
```sql
CREATE DATABASE library_management;
```

### 6. Run Migrations
```bash
php artisan migrate
```

### 7. Seed Database with Demo Data
```bash
php artisan db:seed
```

### 8. Start Development Server
```bash
php artisan serve
```

Visit: http://localhost:8000

## Default Login Credentials

### Admin Account
- Email: admin@library.com
- Password: password

### User Accounts
- Email: john@example.com
- Password: password

- Email: jane@example.com
- Password: password

## Features Overview

### Admin Features
1. **Dashboard** - View statistics (total books, issued books, returned books, total users)
2. **Book Management** - Create, Read, Update, Delete books
3. **Author Management** - Manage authors
4. **Category Management** - Manage categories
5. **Issue/Return Books** - Issue books to users and process returns with fine calculation

### User Features
1. **Browse Books** - View all available books
2. **Search Books** - Search by title, author, or category
3. **My Issued Books** - View currently issued books and history
4. **Profile** - View profile and reading statistics

## Database Schema

### users
- id, name, email, password, role (admin/user), timestamps

### authors
- id, name, bio, timestamps

### categories
- id, name, description, timestamps

### books
- id, title, isbn, author_id, category_id, quantity, available_quantity, timestamps

### book_issues
- id, user_id, book_id, issue_date, due_date, return_date, fine, status (issued/returned), timestamps

## Fine Calculation
- ₹5 per day for late returns
- Calculated automatically when book is returned

## Project Structure
```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/          # Admin controllers
│   │   ├── User/           # User controllers
│   │   └── AuthController.php
│   ├── Middleware/
│   │   └── AdminMiddleware.php
│   └── Requests/           # Form validation
├── Models/                 # Eloquent models
database/
├── migrations/             # Database migrations
└── seeders/               # Database seeders
resources/
└── views/
    ├── admin/             # Admin views
    ├── user/              # User views
    ├── auth/              # Authentication views
    └── layouts/           # Layout templates
public/
└── css/
    └── style.css          # Custom CSS
routes/
└── web.php                # Application routes
```

## Troubleshooting

### Migration Error
If you get migration errors, reset the database:
```bash
php artisan migrate:fresh --seed
```

### Permission Issues
Ensure storage and cache directories are writable:
```bash
chmod -R 775 storage bootstrap/cache
```

### CSS Not Loading
Clear cache:
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## Development Notes
- All validation is server-side using Laravel Form Requests
- Middleware protects admin routes
- Eloquent ORM for database operations
- Blade templating engine for views
- Custom CSS (no frameworks)
- MVC architecture

## Support
For issues or questions, refer to Laravel documentation: https://laravel.com/docs
