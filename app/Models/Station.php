<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'practical_question', 'total_marks'];

    // A station has many procedures
    public function procedures()
    {
        return $this->hasMany(Procedure::class);
    }

    // A station has many MCQs
    public function mcqQuestions()
    {
        return $this->hasMany(MCQQuestion::class);
    }

    // A station has many results
    public function stationResults()
    {
        return $this->hasMany(StationResult::class);
    }
}
