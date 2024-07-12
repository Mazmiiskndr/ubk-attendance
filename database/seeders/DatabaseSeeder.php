<?php

namespace Database\Seeders;

use App\Models\{Role, Setting, User, UserDetail};
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
            SettingSeeder::class,
        ]);

        User::factory(50)->create()->each(function ($user) {
            UserDetail::factory()->create(['user_id' => $user->id]);
        });
    }
}
