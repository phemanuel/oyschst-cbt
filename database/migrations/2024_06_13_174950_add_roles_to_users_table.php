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
        Schema::table('users', function (Blueprint $table) {
            //
            $table->integer('exam_setting');
            $table->integer('qst_bank');
            $table->integer('std_list');
            $table->integer('std_login_status');
            $table->integer('change_course');
            $table->integer('user_create');
            $table->integer('college_setup');
            $table->integer('report');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};
