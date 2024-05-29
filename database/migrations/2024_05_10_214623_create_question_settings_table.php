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
        Schema::create('question_settings', function (Blueprint $table) {
            $table->id();
            $table->string('session1');
            $table->string('department');
            $table->integer('upload_no_of_qst');
            $table->integer('no_of_qst');
            $table->string('level');
            $table->integer('duration');
            $table->string('exam_type');
            $table->string('exam_category');
            $table->enum('exam_status',['Active','Inactive']);
            $table->string('exam_mode');
            $table->date('exam_date');
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
        Schema::dropIfExists('question_settings');
    }
};
