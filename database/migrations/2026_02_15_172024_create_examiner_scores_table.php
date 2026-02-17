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
        Schema::create('examiner_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id'); // matches student_admissions.id
            $table->unsignedBigInteger('station_id'); // matches stations.id
            $table->unsignedBigInteger('procedure_id'); // matches procedures.id
            $table->decimal('score,3,2');
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('student_admissions')
                ->onDelete('cascade');

            $table->foreign('station_id')
                ->references('id')
                ->on('stations')
                ->onDelete('cascade');

            $table->foreign('procedure_id')
                ->references('id')
                ->on('procedures')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('examiner_scores');
    }
};
