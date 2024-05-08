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
            $table->integer('questionno')->nullable();
            $table->integer('noofquestion')->nullable();
            $table->string('session1', 9)->nullable();
            $table->string('department', 53)->nullable();
            $table->string('subject', 16)->nullable();
            $table->integer('uploadnoofquestion')->nullable();
            $table->string('class', 2)->nullable();
            $table->integer('minute')->nullable();
            $table->string('examtype', 4)->nullable();
            $table->string('questiontype', 4)->nullable();
            $table->string('answer', 1)->nullable();
            $table->string('question', 338)->nullable();
            $table->string('graphic', 9)->nullable();
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
