<?php
// database/seeders/UserSeeder.php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin LegalHome',
            'email' => 'admin@legalhome.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);

        // User Biasa
        User::create([
            'name' => 'User Biasa',
            'email' => 'user@legalhome.com',    
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);

        // User Biasa 2
        User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);
    }
}