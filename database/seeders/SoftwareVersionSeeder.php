<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SoftwareVersion;

class SoftwareVersionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        SoftwareVersion::Create( [
            'name' => "Computer Based Test",
            'version'=> "2.5.1",            
        ]);
    }
}
