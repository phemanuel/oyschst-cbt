<?php

namespace App\Imports;

use App\Models\StudentAdmission;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentsImport implements ToModel, WithHeadingRow
{
    /**
     * Create a new model instance for a row in the Excel file.
     *
     * @param  array  $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new StudentAdmission([
            'admission_no' => $row['admission_no'],
            'surname' => $row['surname'],
            'first_name' => $row['first_name'],
            'other_name' => $row['other_name'],
            'department' => $row['department'],
            'phone_no' => $row['phone_no'],
            'state' => $row['state'],
            'level' => $row['level'],
            'sex' => $row['sex'],
            // Add more fields as needed
        ]);
    }
}
