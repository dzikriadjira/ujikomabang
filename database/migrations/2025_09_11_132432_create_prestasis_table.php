<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('category'); // prestasi, penghargaan, pencapaian, dll
            $table->string('level'); // nasional, provinsi, kabupaten, sekolah
            $table->string('year');
            $table->string('student_name')->nullable();
            $table->string('teacher_name')->nullable();
            $table->text('achievement_details')->nullable();
            $table->string('color')->default('blue');
            $table->string('icon')->default('fas fa-trophy');
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestasis');
    }
};
