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
        ]);
    }
}
