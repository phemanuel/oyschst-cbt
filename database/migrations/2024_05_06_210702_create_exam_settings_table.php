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
        Schema::create('exam_settings', function (Blueprint $table) {
            $table->id();
            $table->string('level');
            // $table->string('subject1');
            // $table->string('subject2');
            // $table->string('subject3');
            // $table->string('subject4');
            // $table->string('subject5');
            $table->string('session1');
            $table->string('semester');
            $table->string('department');
            $table->string('exam_type');
            $table->string('exam_category');
            $table->string('exam_mode');
            $table->string('course');
            $table->integer('time_limit');
            $table->integer('no_of_qst');
            $table->integer('upload_no_of_qst');
            $table->integer('duration');
            $table->date('exam_date');
            $table->integer('lock_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exam_settings');
    }
};
