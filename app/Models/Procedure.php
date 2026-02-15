<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    use HasFactory;

    protected $fillable = ['station_id', 'name', 'description', 'marks'];

    // Procedure belongs to a station
    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    // Procedure has many examiner scores
    public function examinerScores()
    {
        return $this->hasMany(ExaminerScore::class);
    }
}
