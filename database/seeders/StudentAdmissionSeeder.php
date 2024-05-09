<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\StudentAdmission;
use Illuminate\Support\Facades\DB;
use Exception;

class studentAdmissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csv = fopen(base_path('database/seeders/data/applicant.csv'), 'r');
        $getData = fgetcsv($csv, 2000, ",");

        DB::beginTransaction();
        try{
            $firstline = true;
            while (($data = fgetcsv($csv, 2000, ",")) !== FALSE) {
                    StudentAdmission::create([
                        'admission_no'  => $data[0],
                        'surname'  => $data[1],
                        'first_name'  => $data[2],
                        'other_name'  => $data[3],
                        'department'  => $data[4],
                        'phone_no'  => $data[5],
                        'state'  => $data[6],
                        'level'  => $data[7],
                        'sex'  => $data[8],
                        'phone_no1'  => $data[9],
                        'user_name'  => $data[10],
                        'password'  => $data[11],
                        'picture_name'  => $data[12],
                        'session1'  => $data[13],
                        'login_status'  => $data[14],
                        'login_attempts'  => $data[15],
                        'user_type'  => $data[16],
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
