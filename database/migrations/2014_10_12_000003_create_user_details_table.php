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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('class_id');
            $table->string('gender', 10)->nullable();
            $table->string('ident_number', 15)->nullable();
            $table->integer('semester')->nullable();
            $table->string('phone_number', 20)->nullable();
            $table->date('birthdate')->nullable()->nullable();
            $table->text('address')->nullable()->nullable();
            $table->timestamps();

            $table->foreign('class_id')
                ->references('id')
                ->on('kelas')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_details');
    }
};