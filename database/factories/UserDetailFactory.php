<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserDetail>
 */
class UserDetailFactory extends Factory
{
    protected $model = UserDetail::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'ident_number' => $this->faker->numerify('##########'),
            'gender' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'class' => $this->faker->randomElement(['A', 'B', 'C', 'D']),
            'semester' => random_int(1, 14),
            'phone_number' => $this->faker->phoneNumber,
            'birthdate' => $this->faker->date(),
            'address' => $this->faker->address,
        ];
    }
}
