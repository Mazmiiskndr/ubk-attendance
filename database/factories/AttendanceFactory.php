<?php

namespace Database\Factories;

use App\Enums\AttendanceStatus;
use App\Models\{User, CourseSchedule};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attendance>
 */
class AttendanceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $attendanceStatus = AttendanceStatus::cases();
        return [
            'user_id' => User::factory(),
            'course_schedule_id' => CourseSchedule::factory(),
            'check_in' => $this->faker->time(),
            'check_out' => $this->faker->optional()->time(),
            'attendance_date' => $this->faker->dateTimeThisMonth(),
            'image_in' => $this->faker->optional()->imageUrl(),
            'image_out' => $this->faker->optional()->imageUrl(),
            'status' => $this->faker->randomElement($attendanceStatus)->value,
            'remarks' => $this->faker->optional()->text(),
        ];
    }
}