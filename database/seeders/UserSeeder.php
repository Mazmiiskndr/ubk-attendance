<?php

namespace Database\Seeders;

use App\Models\Kelas;
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
        // Define roles
        $roles = [
            [
                'role_name' => 'Administrator',
                'role_name_alias' => 'admin'
            ],
            [
                'role_name' => 'Dosen',
                'role_name_alias' => 'dosen'
            ],
            [
                'role_name' => 'Mahasiswa',
                'role_name_alias' => 'mahasiswa'
            ],
        ];

        // Create roles
        foreach ($roles as $roleData) {
            Role::firstOrCreate([
                'name' => $roleData['role_name'],
                'name_alias' => $roleData['role_name_alias']
            ]);
        }

        // Define users
        $users = [
            [
                'role_name_alias' => 'admin',
                'name' => 'Admin User',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => 'admin',
                'status' => 1,
            ],
            // Uncomment if you want to add these users
            // [
            //     'role_name_alias' => 'dosen',
            //     'name' => 'Moch Azmi Iskandar',
            //     'username' => 'mazmiiskndr',
            //     'email' => 'azmiiskandar0@gmail.com',
            //     'password' => 'tasik123',
            //     'status' => 1,
            // ],
            // [
            //     'role_name_alias' => 'mahasiswa',
            //     'name' => 'Azmi Iskandar',
            //     'username' => 'azmi123',
            //     'email' => 'mazmiiskndr@gmail.com',
            //     'password' => 'tasik123',
            //     'status' => 1,
            // ],
        ];

        // $kelas = Kelas::first(); // Ambil ID kelas pertama

        // Create users and assign roles
        foreach ($users as $userData) {
            $role = Role::where('name_alias', $userData['role_name_alias'])->first();

            if ($role) {
                $user = $role->users()->create([
                    'name' => $userData['name'],
                    'username' => $userData['username'],
                    'email' => $userData['email'],
                    'password' => Hash::make($userData['password']),
                    'status' => $userData['status'],
                    'images' => 'default.png',
                ]);

                // // Create user detail for mahasiswa
                // if ($userData['role_name_alias'] === 'mahasiswa' && $kelas) {
                //     UserDetail::create([
                //         'user_id' => $user->id,
                //         'class_id' => $kelas->id,
                //         'gender' => 'Laki-laki',
                //         'ident_number' => '7101200006',
                //         'phone_number' => '082118923691',
                //         'semester' => 7,
                //         'birthdate' => "2001-01-06",
                //         'address' => "Perum Griya Mitra Batik Jl. Batik Keris E148",
                //     ]);
                // }
            }
        }
    }
}
