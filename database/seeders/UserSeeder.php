<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = [
            [
                'role_name' => 'Administrator',
                'role_name_alias' => 'admin',
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'admin',
                'status' => 1,
            ],
        ];

        foreach ($admins as $key => $value) {
            Role::create([
                'name' => $value['role_name'],
                'name_alias' => $value['role_name_alias']
            ])->users()->create([
                'name' => $value['name'],
                'username' => $value['username'],
                'email' => $value['email'],
                'password' => Hash::make($value['password']),
                'status' => $value['status'],
                'images' => 'default.png',
            ]);
        }
    }
}
