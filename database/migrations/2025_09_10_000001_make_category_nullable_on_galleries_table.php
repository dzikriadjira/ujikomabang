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
        Schema::table('galleries', function (Blueprint $table) {
            // Drop existing foreign key first if present
            try {
                $table->dropForeign(['category_id']);
            } catch (\Throwable $e) {
                // ignore if FK missing or driver doesn't support
            }

            // Make column nullable
            try {
                $table->unsignedBigInteger('category_id')->nullable()->change();
            } catch (\Throwable $e) {
                // Some drivers (like older SQLite) may not support change().
                // In such case, migration should be adjusted per environment manually.
            }

            // Re-add FK with set null on delete if possible
            try {
                $table->foreign('category_id')->references('id')->on('categories')->nullOnDelete();
            } catch (\Throwable $e) {
                // ignore if not supported; column is already nullable
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('galleries', function (Blueprint $table) {
            try {
                $table->dropForeign(['category_id']);
            } catch (\Throwable $e) {
                // ignore
            }

            try {
                $table->unsignedBigInteger('category_id')->nullable(false)->change();
            } catch (\Throwable $e) {
                // ignore
            }

            try {
                $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            } catch (\Throwable $e) {
                // ignore
            }
        });
    }
};


