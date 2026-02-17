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
        Schema::create('station_results', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('student_id'); // match student_admissions.id
            $table->unsignedBigInteger('station_id'); // match stations.id
            $table->decimal('examiner_score,3,2')->default(0);
            $table->decimal('mcq_score,3,2')->default(0);
            $table->decimal('total_score,3,2')->default(0);
            $table->timestamps();

            // Foreign keys
            $table->foreign('student_id')
                ->references('id')
                ->on('student_admissions')
                ->onDelete('cascade');

            $table->foreign('station_id')
                ->references('id')
                ->on('stations')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('station_results');
    }
};
