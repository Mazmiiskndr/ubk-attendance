<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('course_schedule_id');
            $table->dateTime('check_in');
            $table->dateTime('check_out')->nullable();
            $table->dateTime('attendance_date');
            $table->string('image_in', 191)->nullable();
            $table->string('image_out', 191)->nullable();
            $table->enum('status', [
                'H',
                'S',
                'I',
                'T',
                'A'
            ]);
            $table->text('remarks')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('course_schedule_id')
                ->references('id')
                ->on('course_schedules')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
