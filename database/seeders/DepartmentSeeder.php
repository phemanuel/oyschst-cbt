<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Department;
use Illuminate\Support\Facades\DB;
use Exception;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csv = fopen(base_path('database/seeders/data/dept.csv'), 'r');
        $getData = fgetcsv($csv, 2000, ",");

        DB::beginTransaction();
        try{
            $firstline = true;
            while (($data = fgetcsv($csv, 2000, ",")) !== FALSE) {
                    Department::create([
                        'department'  => $data[0],
                    ]);
                $firstline = false;
            }
            DB::commit();
            fclose($csv);

        }catch(Exception $e){
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
