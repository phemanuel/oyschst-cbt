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
        User::updateOrCreate([
            'email' => 'admin@gmail.com'
        ], [
            'name' => 'Admin CBT',
            'email'=>'admin@gmail.com',
            'password' => bcrypt('password'), 
            'email_verified_status' => 1,
            'login_attempts' => 0,   
            'exam_settings' => 1,
            'qst_bank' => 1,
            'std_list' => 1,
            'std_login_status' => 1,
            'change_course' => 1,
            'user_create' => 1,
            'college_setup' => 1,
            'report' => 1,  
            'user_type' => "superadmin",      
        ]);
    }
}
