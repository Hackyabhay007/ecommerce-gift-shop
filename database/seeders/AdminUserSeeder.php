<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Ensure you have the correct User model namespace
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com', // Set your admin email
            'password' => Hash::make('password'), // Set your admin password (hashed)
            'role' => 'admin', // Optional, only if you are using roles in your users table
        ]);
    }
}
