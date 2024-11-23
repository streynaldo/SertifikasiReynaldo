<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => "Admin",
                'email' => "admin@gmail.com",
                'password' => Hash::make('admin123'),
                'photo' => 'admin.jpg',
                'phone' => '081234567891',
                'role' => 1,
            ],
            [
                'name' => "Reynaldo",
                'email' => "reynaldo@gmail.com",
                'password' => Hash::make('tes12345'),
                'photo' => 'user.jpg',
                'phone' => '081234567891',
                'role' => 2,
            ],
        ];

        foreach ($data as $item) {
            User::create([
                'name' => $item['name'],
                'email' => $item['email'],
                'password' => $item['password'],
                'photo' => $item['photo'],
                'phone' => $item['phone'],
                'role' => $item['role'],
            ]);
        }
    }
}
