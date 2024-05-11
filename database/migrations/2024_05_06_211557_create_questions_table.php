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
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->integer('question_no')->nullable();
            $table->integer('no_of_qst')->nullable();
            $table->string('session1')->nullable();
            $table->string('department')->nullable();
            $table->integer('upload_no_of_qst')->nullable();
            $table->string('class')->nullable();
            $table->string('exam_type')->nullable();
            $table->string('exam_category')->nullable();
            $table->string('exam_mode')->nullable();
            $table->string('question_type')->nullable();
            $table->string('answer')->nullable();
            $table->text('question')->nullable();
            $table->string('graphic')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
