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
            $table->string('class');
            $table->string('subject1');
            $table->string('subject2');
            $table->string('subject3');
            $table->string('subject4');
            $table->string('subject5');
            $table->string('session1');
            $table->string('semester');
            $table->string('department');
            $table->string('exam_type');
            $table->integer('time_limit');
            $table->integer('no_of_qst');
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
