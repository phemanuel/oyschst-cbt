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
            //exam setting---
            $table->integer('exam_setting');
            $table->integer('edit_exam_setting');
            //----question bank----
            $table->integer('qst_bank');
            $table->integer('create_question_bank');
            $table->integer('edit_question_bank');
            //---student list/upload----
            $table->integer('std_list');
            $table->integer('create_std_list');
            $table->integer('edit_std_list');
            $table->integer('delete_std_list');
            //----student login status---
            $table->integer('std_login_status');
            $table->integer('edit_std_login_status');
            //-----change of course-----
            $table->integer('change_course');
            $table->integer('edit_change_course');
            //----Users create----
            $table->integer('user_create');
            $table->integer('create_user_create');
            $table->integer('edit_user_create');
            $table->integer('status_user_create');
            //-----College setup
            $table->integer('college_setup');
            $table->integer('create_college_setup');
            $table->integer('edit_college_setup');
            $table->integer('delete_college_setup');
            //----report-----
            $table->integer('report');
            $table->integer('check_report');
            $table->integer('export_report');
            //---User status
            $table->enum('user_status',['Active','Inactive']);
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
