<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseSchedule;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CourseSchedule>
 */
class CourseScheduleFactory extends Factory
{
    protected $model = CourseSchedule::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => Course::factory(),
            'check_in_start' => $this->faker->time(),
            'check_in_end' => $this->faker->time(),
            'check_out_start' => $this->faker->time(),
            'check_out_end' => $this->faker->time(),
        ];
    }
}
