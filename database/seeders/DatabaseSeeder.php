<?php

namespace Database\Seeders;

use App\Models\{Role, Setting, User, UserDetail};
use App\Models\Course;
use App\Models\CourseSchedule;
use App\Models\Kelas;
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
        // Buat 10 instance Kelas
        $kelas = Kelas::factory()->count(10)->create();

        // Buat 50 instance User dengan UserDetail yang memiliki class_id
        User::factory(50)->create()->each(function ($user) use ($kelas) {
            UserDetail::factory()->create([
                'user_id' => $user->id,
                'class_id' => $kelas->random()->id, // Assign random class_id from the created Kelas instances
            ]);
        });

        Course::factory()
            ->count(10)
            ->has(CourseSchedule::factory()->count(3), 'schedules') // Menggunakan nama relasi 'schedules'
            ->create();
    }
}
