<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StationResult extends Model
{
    use HasFactory;

    protected $fillable = ['student_id', 'station_id', 'examiner_score', 'mcq_score', 
    'total_score','mcq_time_left','mcq_submitted'];

    public function student()
    {
        return $this->belongsTo(StudentAdmission::class, 'student_id');
    }

    public function station()
    {
        return $this->belongsTo(Station::class);
    }
}
