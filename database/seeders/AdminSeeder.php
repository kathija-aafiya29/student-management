<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@admin.com'], // Check by email to avoid duplicate entries
            [
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123'), // Securely hash the password
                'role' => 'admin', // Assuming you have a role field
                'created_at' => now(),
                'updated_at' => now(),
                'role'=> 'admin'
            ]
        );
    }
}
