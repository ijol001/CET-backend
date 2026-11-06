<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

   public function up(): void
{
    Schema::create('nptel_courses', function (Blueprint $table) {
        $table->id();
        $table->string('title');
        $table->string('slug')->unique();

        $table->string('department')->nullable();
        $table->enum('course_type', ['web', 'video']);
        $table->string('phase', 10)->nullable();

        $table->text('developers')->nullable();
        $table->string('course_url', 2048)->nullable();

        $table->enum('status', [
            'draft',
            'published',
            'archived',
        ])->default('draft');

        $table->timestamps();
    });
}
};
