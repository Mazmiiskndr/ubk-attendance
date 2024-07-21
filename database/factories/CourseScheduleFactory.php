<?php

namespace Database\Factories;

use App\Enums\DayOfWeek;
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
        $days = DayOfWeek::cases();
        return [
            'course_id' => Course::factory(),
            'day' => $this->faker->randomElement($days)->value,
            'check_in_start' => $this->faker->time('H:i'),
            'check_in_end' => $this->faker->time('H:i'),
            'check_out_start' => $this->faker->time('H:i'),
            'check_out_end' => $this->faker->time('H:i'),
        ];
    }
}
