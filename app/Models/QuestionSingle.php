<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSingle extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_no', 
        'no_of_qst', 
        'session1', 
        'department',
        'upload_no_of_qst', 
        'level',
        'exam_type', 
        'exam_category',
        'exam_mode',  
        'question_type', 
        'answer', 
        'question', 
        'graphic',
        'course',
        'semester',
        'option_a',
        'option_b',
        'option_c',
        'option_d',
    ];
}
