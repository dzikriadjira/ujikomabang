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
        Schema::create('jurusans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('full_name');
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('color')->default('blue');
            $table->json('competencies')->nullable(); // Array of competencies
            $table->json('careers')->nullable(); // Array of career prospects
            $table->string('icon')->default('fas fa-graduation-cap');
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jurusans');
    }
};
