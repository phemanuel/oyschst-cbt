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
        Schema::create('mcq_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('mcq_id'); // matches mcq_questions.id
            $table->string('option_text');
            $table->boolean('is_correct')->default(false); // one correct per question
            $table->timestamps();

            $table->foreign('mcq_id')
                ->references('id')
                ->on('mcq_questions')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq_options');
    }
};
