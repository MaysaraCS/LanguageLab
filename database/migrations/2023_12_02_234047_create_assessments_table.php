<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('assessments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('due_date');
            $table->integer('max_score');
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
