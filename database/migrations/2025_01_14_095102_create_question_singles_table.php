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
        Schema::create('question_singles', function (Blueprint $table) {
            $table->id();
            $table->integer('question_no');
            $table->integer('no_of_qst');
            $table->string('session1');
            $table->string('department');
            $table->integer('upload_no_of_qst');
            $table->string('level');
            $table->string('exam_type');
            $table->string('exam_category');
            $table->string('exam_mode');
            $table->string('question_type');
            $table->string('answer');
            $table->text('question');
            $table->string('graphic');
            $table->string('course');
            $table->string('semester');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_singles');
    }
};
