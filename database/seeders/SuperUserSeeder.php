<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class SuperUserSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('1'), // Substitua por uma senha segura
            'is_admin' => true, // Certifique-se de que a tabela `users` tem uma coluna `is_admin`
        ]);
    }
}