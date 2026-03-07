<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['name' => 'Budi Santoso',   'email' => 'budi@example.com',   'password' => Hash::make('password')],
            ['name' => 'Siti Rahayu',    'email' => 'siti@example.com',    'password' => Hash::make('password')],
            ['name' => 'Agus Prasetyo',  'email' => 'agus@example.com',   'password' => Hash::make('password')],
            ['name' => 'Dewi Lestari',   'email' => 'dewi@example.com',   'password' => Hash::make('password')],
            ['name' => 'Eko Wijaya',     'email' => 'eko@example.com',    'password' => Hash::make('password')],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}
