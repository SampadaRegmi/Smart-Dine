<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'sampada regmi',
            'email' => 'sampadaregmi90@gmail.com',
            'phone' => '9852025879',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);
        
    }
}
