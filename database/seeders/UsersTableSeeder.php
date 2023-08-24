<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        //
        User::create([
            'name' => 'abdullah',
            'email' => 'a@example.com',
            'password' => Hash::make('abdallah2002'),
            'type' => 'admin', // or 'user' based on your enum
        ]);

        User::create([
            'name' => 'abdullah',
            'email' => 'aaa@example.com',
            'password' => Hash::make('abdallah2002'),
            'type' => 'user', // or 'user' based on your enum
        ]);



        
    }
}
