<?php

namespace Database\Factories;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Fetch the role IDs for 'mahasiswa' and 'dosen'
        $roleMahasiswa = Role::where('name_alias', 'mahasiswa')->first();
        $roleDosen = Role::where('name_alias', 'dosen')->first();

        // Select a random role ID from the fetched roles
        $roleId = $this->faker->randomElement([$roleMahasiswa->id, $roleDosen->id]);

        return [
            'name' => $this->faker->name,
            'username' => $this->faker->userName(),
            'email' => $this->faker->unique()->safeEmail,
            'password' => Hash::make('password'),
            'status' => $this->faker->randomElement([0, 1]),
            'role_id' => $roleId,
            'images' => 'default.png',
        ];
    }

}
