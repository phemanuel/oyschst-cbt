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
        Schema::create('theory_answers', function (Blueprint $table) {
            $table->id();
            $table->integer('examstatus');
            $table->string('studentname');
            $table->double('score');
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
            $table->text('question');
            $table->text('answer');
            $table->string('graphic');
            $table->string('course');
            $table->string('semester');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('theory_answers');
    }
};
