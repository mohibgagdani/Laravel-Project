@echo off
echo ========================================
echo Library Management System - Quick Setup
echo ========================================
echo.

echo Step 1: Copying .env file...
copy .env.example .env
echo.

echo Step 2: Installing dependencies...
call composer install
echo.

echo Step 3: Generating application key...
call php artisan key:generate
echo.

echo Step 4: Running migrations...
call php artisan migrate
echo.

echo Step 5: Seeding database...
call php artisan db:seed
echo.

echo ========================================
echo Setup Complete!
echo ========================================
echo.
echo Default Admin Login:
echo Email: admin@library.com
echo Password: password
echo.
echo Default User Login:
echo Email: john@example.com
echo Password: password
echo.
echo Starting development server...
echo Visit: http://localhost:8000
echo.
call php artisan serve
