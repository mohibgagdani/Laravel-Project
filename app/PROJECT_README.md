# 📚 Library Management System

A complete web-based Library Management System built with Laravel, MySQL, and custom CSS.

## ✨ Features

### 🔐 Authentication
- User registration and login
- Role-based access control (Admin & User)
- Secure password hashing
- Session management

### 👨‍💼 Admin Features
- **Dashboard**: View real-time statistics
  - Total books in library
  - Currently issued books
  - Returned books count
  - Total registered users
  
- **Book Management**: Full CRUD operations
  - Add new books with ISBN, author, category
  - Edit book details and quantity
  - Delete books
  - Track available vs total quantity
  
- **Author Management**: Manage book authors
  - Create, edit, delete authors
  - View books count per author
  
- **Category Management**: Organize books by categories
  - Create, edit, delete categories
  - View books count per category
  
- **Issue/Return Books**:
  - Issue books to users with due dates
  - Process book returns
  - Automatic fine calculation (₹5/day for late returns)
  - Track issue history

### 👤 User Features
- **Browse Books**: View all available books
- **Search**: Find books by title, author, or category
- **My Issued Books**: View currently borrowed books
- **Due Dates & Fines**: Track return dates and pending fines
- **Profile**: View reading statistics and account info

## 🛠️ Technology Stack

- **Backend**: Laravel 11.x (PHP 8.2+)
- **Database**: MySQL
- **Frontend**: Blade Templates
- **Styling**: Custom CSS (No frameworks)
- **Architecture**: MVC Pattern

## 📋 Requirements

- PHP >= 8.2
- Composer
- MySQL >= 5.7
- Apache/Nginx web server

## 🚀 Installation

### Quick Setup (Windows)
1. Ensure MySQL is running
2. Create database: `library_management`
3. Run the setup script:
```bash
setup.bat
```

### Manual Setup

1. **Install Dependencies**
```bash
composer install
```

2. **Environment Configuration**
```bash
copy .env.example .env
```

Edit `.env` and configure database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=library_management
DB_USERNAME=root
DB_PASSWORD=your_password
```

3. **Generate Application Key**
```bash
php artisan key:generate
```

4. **Run Migrations**
```bash
php artisan migrate
```

5. **Seed Database**
```bash
php artisan db:seed
```

6. **Start Server**
```bash
php artisan serve
```

Visit: http://localhost:8000

## 🔑 Default Credentials

### Admin Account
- **Email**: admin@library.com
- **Password**: password

### User Accounts
- **Email**: john@example.com / jane@example.com
- **Password**: password

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Admin/              # Admin controllers
│   │   │   ├── DashboardController.php
│   │   │   ├── BookController.php
│   │   │   ├── AuthorController.php
│   │   │   ├── CategoryController.php
│   │   │   └── BookIssueController.php
│   │   ├── User/               # User controllers
│   │   │   ├── BookController.php
│   │   │   ├── IssueController.php
│   │   │   └── ProfileController.php
│   │   └── AuthController.php  # Authentication
│   ├── Middleware/
│   │   └── AdminMiddleware.php # Admin access control
│   └── Requests/               # Form validation
│       ├── BookRequest.php
│       └── IssueBookRequest.php
├── Models/                     # Eloquent models
│   ├── User.php
│   ├── Book.php
│   ├── Author.php
│   ├── Category.php
│   └── BookIssue.php
database/
├── migrations/                 # Database migrations
└── seeders/
    └── DatabaseSeeder.php      # Demo data
resources/
└── views/
    ├── layouts/
    │   └── app.blade.php       # Main layout
    ├── auth/                   # Login/Register
    ├── admin/                  # Admin views
    └── user/                   # User views
public/
└── css/
    └── style.css               # Custom CSS
routes/
└── web.php                     # Application routes
```

## 🗄️ Database Schema

### Tables
- **users**: User accounts (admin/user roles)
- **books**: Book inventory
- **authors**: Book authors
- **categories**: Book categories
- **book_issues**: Issue/return records

See [DATABASE_SCHEMA.md](DATABASE_SCHEMA.md) for detailed schema.

## 🎨 UI Design

- Clean, modern interface
- Responsive sidebar navigation
- Card-based layouts
- Table-based data display
- Form validation with error messages
- Color-coded status badges
- No external CSS frameworks

## 🔒 Security Features

- Password hashing with bcrypt
- CSRF protection on all forms
- Middleware-based route protection
- SQL injection prevention (Eloquent ORM)
- XSS protection (Blade templating)
- Session security

## 📊 Business Logic

### Fine Calculation
- **Rate**: ₹5 per day
- **Trigger**: When return_date > due_date
- **Formula**: (days_late × 5)
- **Auto-calculation**: On book return

### Book Availability
- Automatically decrements on issue
- Automatically increments on return
- Prevents issuing unavailable books

## 🧪 Testing

To reset and reseed database:
```bash
php artisan migrate:fresh --seed
```

## 📝 Code Quality

- **Clean Code**: Readable, well-commented
- **MVC Pattern**: Proper separation of concerns
- **Eloquent ORM**: Database abstraction
- **Form Requests**: Server-side validation
- **Blade Components**: Reusable templates
- **RESTful Routes**: Standard naming conventions

## 🎓 Learning Resources

This project demonstrates:
- Laravel routing and controllers
- Eloquent relationships (hasMany, belongsTo)
- Middleware implementation
- Form validation
- Blade templating
- Database migrations and seeders
- Authentication and authorization
- CRUD operations

## 📄 License

This project is open-source and available for educational purposes.

## 👨‍💻 Developer Notes

- Built for beginners learning Laravel
- Production-ready structure
- Follows Laravel best practices
- Beginner-friendly code comments
- No complex dependencies

## 🐛 Troubleshooting

### Migration Errors
```bash
php artisan migrate:fresh --seed
```

### Cache Issues
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

### Permission Issues (Linux/Mac)
```bash
chmod -R 775 storage bootstrap/cache
```

## 📞 Support

For Laravel documentation: https://laravel.com/docs

---

**Made with ❤️ using Laravel**
