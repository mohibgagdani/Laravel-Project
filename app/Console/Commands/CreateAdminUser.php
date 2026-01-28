<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdminUser extends Command
{
    protected $signature = 'admin:create';
    protected $description = 'Create an admin user';

    public function handle()
    {
        $email = 'admin@library.com';
        
        if (User::where('email', $email)->exists()) {
            $this->error('Admin user already exists!');
            return 1;
        }

        User::create([
            'name' => 'Admin User',
            'email' => $email,
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        $this->info('Admin user created successfully!');
        $this->info('Email: admin@library.com');
        $this->info('Password: password');
        return 0;
    }
}
