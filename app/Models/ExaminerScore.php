<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExaminerScore extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'station_id', 'procedure_id', 'score'];

    public function student()
    {
        return $this->belongsTo(StudentAdmission::class, 'student_id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    public function procedure()
    {
        return $this->belongsTo(Procedure::class);
    }
}
