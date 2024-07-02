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
        Schema::create('student_admissions', function (Blueprint $table) {
            $table->id();
            $table->text('admission_no')->unique();
            $table->text('first_name')->nullable();
            $table->text('surname')->nullable();
            $table->text('department')->nullable();
            $table->text('department1')->nullable();
            $table->text('other_name')->nullable();
            $table->text('phone_no')->nullable();
            $table->text('state')->nullable();
            $table->text('level')->nullable();
            $table->text('sex')->nullable();
            $table->text('phone_no1')->nullable();
            $table->text('user_name')->nullable();
            $table->text('picture_name')->nullable();
            $table->text('password')->nullable();
            $table->text('session1')->nullable();
            $table->text('login_status')->nullable(); 
            $table->integer('login_attempts')->nullable(); 
            $table->string('user_type')->nullable;             
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_admissions');
    }
};
