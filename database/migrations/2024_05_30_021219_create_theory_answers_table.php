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
            $table->string('studentno');
            $table->string('studentname');
            $table->double('total_score');
            $table->integer('no_of_qst');
            $table->string('session1');
            $table->string('department');
            $table->integer('upload_no_of_qst');
            $table->string('level');
            $table->string('exam_type');
            $table->string('exam_category');
            $table->string('exam_mode');
            $table->string('course');
            $table->string('semester');
            $table->integer('minute');
            $table->integer('hour');
            $table->date('exam_date');
            //----
            $table->integer('A1')->nullable();
            $table->integer('A2')->nullable();
            $table->integer('A3')->nullable();
            $table->integer('A4')->nullable();
            $table->integer('A5')->nullable();
            $table->integer('A6')->nullable();
            $table->integer('A7')->nullable();
            $table->integer('A8')->nullable();
            $table->integer('A9')->nullable();
            $table->integer('A10')->nullable();
            //----
            $table->text('Q1')->nullable();
            $table->text('Q2')->nullable();
            $table->text('Q3')->nullable();
            $table->text('Q4')->nullable();
            $table->text('Q5')->nullable();
            $table->text('Q6')->nullable();
            $table->text('Q7')->nullable();
            $table->text('Q8')->nullable();
            $table->text('Q9')->nullable();
            $table->text('Q10')->nullable();
            //----
            $table->text('ANS1')->nullable();
            $table->text('ANS2')->nullable();
            $table->text('ANS3')->nullable();
            $table->text('ANS4')->nullable();
            $table->text('ANS5')->nullable();
            $table->text('ANS6')->nullable();
            $table->text('ANS7')->nullable();
            $table->text('ANS8')->nullable();
            $table->text('ANS9')->nullable();
            $table->text('ANS10')->nullable();
            //--
            $table->double('score1')->nullable();
            $table->double('score2')->nullable();
            $table->double('score3')->nullable();
            $table->double('score4')->nullable();
            $table->double('score5')->nullable();
            $table->double('score6')->nullable();
            $table->double('score7')->nullable();
            $table->double('score8')->nullable();
            $table->double('score9')->nullable();
            $table->double('score10')->nullable();
            //--
            $table->string('QT1')->nullable();
            $table->string('QT2')->nullable();
            $table->string('QT3')->nullable();
            $table->string('QT4')->nullable();
            $table->string('QT5')->nullable();
            $table->string('QT6')->nullable();
            $table->string('QT7')->nullable();
            $table->string('QT8')->nullable();
            $table->string('QT9')->nullable();
            $table->string('QT10')->nullable();
			//---
			$table->string('G1')->nullable();
            $table->string('G2')->nullable();
            $table->string('G3')->nullable();
            $table->string('G4')->nullable();
            $table->string('G5')->nullable();
            $table->string('G6')->nullable();
            $table->string('G7')->nullable();
            $table->string('G8')->nullable();
            $table->string('G9')->nullable();
            $table->string('G10')->nullable();
            $table->integer('grading_status');
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
