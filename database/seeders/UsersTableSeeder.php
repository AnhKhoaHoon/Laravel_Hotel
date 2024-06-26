<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            // Admin
            [
                'name' =>  'Admin',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin@gmail.com'),
                'status' => 'active',
                'role'=>'admin',
            ],
            // User
            [
                'name'=>'User',
                'email'=>'user@gmail.com',
                'password'=>Hash::make('user1@gmail.com'),
                'status'=>'active',
                'role'=>'user',
            ]
        ]);
    }
}
