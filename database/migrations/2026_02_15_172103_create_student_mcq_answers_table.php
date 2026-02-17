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
        Schema::create('student_mcq_answers', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('student_id'); // must match student_admissions.id
            $table->unsignedBigInteger('mcq_id');     // must match mcq_questions.id
            $table->unsignedBigInteger('option_id')->nullable(); // mcq_options.id
            $table->decimal('score,3,2')->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign('student_id')
                ->references('id')
                ->on('student_admissions')
                ->onDelete('cascade');

            $table->foreign('mcq_id')
                ->references('id')
                ->on('mcq_questions')
                ->onDelete('cascade');

            $table->foreign('option_id')
                ->references('id')
                ->on('mcq_options')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_mcq_answers');
    }
};
