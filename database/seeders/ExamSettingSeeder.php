<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ExamSetting;
use Illuminate\Support\Facades\DB;
use Exception;

class ExamSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $csv = fopen(base_path('database/seeders/data/exam_setting.csv'), 'r');
        $getData = fgetcsv($csv, 2000, ",");

        DB::beginTransaction();
        try{
            $firstline = true;
            while (($data = fgetcsv($csv, 2000, ",")) !== FALSE) {
                    ExamSetting::create([
                        'class'  => $data[0],
                        'subject1'  => $data[1],
                        'subject2'  => $data[2],
                        'subject3'  => $data[3],
                        'subject4'  => $data[4],
                        'subject5'  => $data[5],
                        'session1'  => $data[6],
                        'semester'  => $data[7],
                        'department'  => $data[8],
                        'exam_type'  => $data[9],
                        'exam_category'  => $data[10],
                        'time_limit'  => $data[11],
                        'no_of_qst'  => $data[12],
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
