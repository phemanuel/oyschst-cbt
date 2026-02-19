<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMcqAnswer extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'station_id','mcq_id', 'option_id', 'score'];

    public function student()
    {
        return $this->belongsTo(StudentAdmission::class, 'student_id');
    }

    public function question()
    {
        return $this->belongsTo(McqQuestion::class, 'mcq_id');
    }

    public function selectedOption()
    {
        return $this->belongsTo(McqOption::class, 'option_id');
    }
}
