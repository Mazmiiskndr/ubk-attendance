<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\UserDetail;
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
            [
                'role_name' => 'Dosen',
                'role_name_alias' => 'dosen',
                'name' => 'Moch Azmi Iskandar',
                'username' => 'mazmiiskndr',
                'email' => 'azmiiskandar0@gmail.com',
                'password' => 'tasik123',
                'status' => 1,
            ],
            [
                'role_name' => 'Mahasiswa',
                'role_name_alias' => 'mahasiswa',
                'name' => 'Azmi Iskandar',
                'username' => 'azmi123',
                'email' => 'mazmiiskndr@gmail.com',
                'password' => 'tasik123',
                'status' => 1,
            ],
        ];

        foreach ($admins as $key => $value) {
            $role = Role::create([
                'name' => $value['role_name'],
                'name_alias' => $value['role_name_alias']
            ]);

            $user = $role->users()->create([
                'name' => $value['name'],
                'username' => $value['username'],
                'email' => $value['email'],
                'password' => Hash::make($value['password']),
                'status' => $value['status'],
                'images' => 'default.png',
            ]);

            // Check if the user is a mahasiswa and create user detail
            if ($value['role_name_alias'] === 'mahasiswa') {
                UserDetail::create([
                    'user_id' => $user->id,
                    'gender' => 'Laki-laki',
                    'indent_number' => '7101200006',
                    'phone_number' => '082118923691',
                    'position' => "Semester 2",
                    'birthdate' => "2001-01-06",
                    'address' => "Perum Griya Mitra Batik Jl. Batik Keris E148",
                ]);
            }
        }
    }
}
