<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoadingCheck;

class LoadingCheckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        LoadingCheck::Create( [
            'loading_check' => 1,
            'app_check'=> 1,            
        ]);
    }
}
