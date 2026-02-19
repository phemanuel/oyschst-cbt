<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqQuestion extends Model
{
    use HasFactory;

    protected $fillable = ['station_id', 'question', 'mark'];

    // MCQ belongs to a station
    public function station()
    {
        return $this->belongsTo(Station::class);
    }

    // MCQ has many options
    public function options()
    {
        return $this->hasMany(McqOption::class, 'mcq_id');
    }

    // MCQ has many student answers
    public function studentAnswers()
    {
        return $this->hasMany(StudentMcqAnswer::class, 'mcq_id');
    }
}
