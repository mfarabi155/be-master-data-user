<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'user_fullname' => 'Admin User',
            'user_email' => 'admin@example.com',
            'password' => Hash::make('adminpassword'),
            'user_status' => false,
        ]);
    }
}
