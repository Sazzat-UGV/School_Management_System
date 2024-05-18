<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // admin user
        User::create([
            'name' => 'Sazzat',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin@gmail.com'),
            'user_type'=>'admin',
        ]);

        //teacher user
        User::create([
            'name' => 'Teacher',
            'email' => 'teacher@gmail.com',
            'password' => Hash::make('teacher@gmail.com'),
            'user_type'=>'teacher',
        ]);

        // student user
        User::create([
            'name' => 'Student',
            'email' => 'student@gmail.com',
            'password' => Hash::make('student@gmail.com'),
            'user_type'=>'student',
        ]);

        // parent user
        User::create([
            'name' => 'Parent',
            'email' => 'parent@gmail.com',
            'password' => Hash::make('parent@gmail.com'),
            'user_type'=>'parent',
        ]);
    }
}
