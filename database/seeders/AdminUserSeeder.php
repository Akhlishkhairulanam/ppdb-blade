<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@sditbaitulihsan.sch.id',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);
    }
}