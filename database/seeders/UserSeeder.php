<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'
        ],
            [
                'name' => 'Admin CBT',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('password'),
                'email_verified_status' => 1,
                'login_attempts' => 0,
                'exam_settings' => 1,
                'edit_exam_settings' => 1, // Added attribute
                'qst_bank' => 1,
                'create_question_bank' => 1, // Added attribute
                'edit_question_bank' => 1, // Added attribute
                'std_list' => 1,
                'create_std_list' => 1, // Added attribute
                'edit_std_list' => 1, // Added attribute
                'delete_std_list' => 1, // Added attribute
                'std_login_status' => 1,
                'edit_std_login_status' => 1, // Added attribute
                'change_course' => 1,
                'edit_change_course' => 1, // Added attribute
                'user_create' => 1,
                'create_user_create' => 1, // Added attribute
                'edit_user_create' => 1, // Added attribute
                'status_user_create' => 1, // Added attribute
                'college_setup' => 1,
                'create_college_setup' => 1, // Added attribute
                'edit_college_setup' => 1, // Added attribute
                'delete_college_setup' => 1, // Added attribute
                'report' => 1,
                'check_report' => 1, // Added attribute
                'export_report' => 1, // Added attribute
                'grading_report' => 1,
                'user_type' => "superadmin",
            ]
        );
    }
}
