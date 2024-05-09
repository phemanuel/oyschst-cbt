<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\CollegeSetup;

class CollegeSetupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        CollegeSetup::Create( [
            'name' => "Oyo State College of Health Science and Technology",
            'avatar'=> "college/avatar.jpg",
            'phone' => "08035882299",
            'email' => "admin@gmail.com",
            'address' => "Beside fan-milk, Eleyele,Ibadan, Oyo State",
            'web_url' => "http://www.admin@example.com",

        ]);
    }
}
