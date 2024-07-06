<?php

namespace Database\Seeders;

use App\Models\{Role, User, UserDetail};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
        ]);

        //Make roles and users with details
        Role::factory()->count(5)->create()->each(function ($role) {
            User::factory()->count(10)->create(['role_id' => $role->id])->each(function ($user) {
                UserDetail::factory()->create(['user_id' => $user->id]);
            });
        });
    }
}
