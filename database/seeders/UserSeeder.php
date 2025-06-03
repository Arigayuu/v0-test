<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Delete existing admin user if it exists
        User::where('email', 'admin@gmail.com')->delete();

        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // Create regular user
        User::create([
            'name' => 'Testing User',
            'email' => 'testing@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}
