<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(ExamSettingSeeder::class);
        $this->call(AcademicSessionSeeder::class);
        $this->call(DepartmentSeeder::class);
        $this->call(LoadingCheckSeeder::class);
        $this->call(SoftwareVersionSeeder::class);
        $this->call(StudentAdmissionSeeder::class);
    }
}
