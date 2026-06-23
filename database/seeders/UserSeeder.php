<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DB::table('users')->insert([
        //     'name' => "razan",
        //     'email' => "ra@gmail.com",
        //     'email_verified_at' => now(),
        //     'password' => Hash::make('password'),
        //     'username'=>'raaa',
        //     'timezone'=>'Asia/Gaza' 
        // ]);
        DB::table('users')->insert([
            'name' => "admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'type' => 'admin',
            'username' => 'admin',
            'timezone' => 'Asia/Gaza',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('users')->insert([
            'name' => "Super admin",
            'email' => "super@gmail.com",
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'type' => 'super-admin',
            'username' => 'super',
            'timezone' => 'Asia/Gaza',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
