<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'admin@galeri-dzik.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'phone' => '08123456789',
            'address' => 'Jl. Sekolah No. 123, Kota',
        ]);

        // Create sample user
        User::create([
            'name' => 'User Demo',
            'username' => 'userdemo',
            'email' => 'user@galeri-dzik.com',
            'password' => Hash::make('user123'),
            'role' => 'user',
            'phone' => '08987654321',
            'address' => 'Jl. Contoh No. 456, Kota',
        ]);
    }
}
