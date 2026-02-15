<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class McqOption extends Model
{
    use HasFactory;

    protected $fillable = ['mcq_id', 'option_text', 'is_correct'];

    // Option belongs to a question
    public function question()
    {
        return $this->belongsTo(MCQQuestion::class, 'mcq_id');
    }

    // Option may be selected by students
    public function studentAnswers()
    {
        return $this->hasMany(StudentMCQAnswer::class, 'option_id');
    }
}
