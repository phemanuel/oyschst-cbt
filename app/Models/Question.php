<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
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
    ];

    public function scopeCommonConditionsQst($query, $cbtEvaluation, $examSetting, $studentData)
    {
        return $query->where('session1', $examSetting->session1)
                     ->where('department', $studentData->department)
                     ->where('level', $studentData->level)
                     ->where('course', $examSetting->course)
                     ->where('exam_mode', $examSetting->exam_mode)
                     ->where('exam_type', $examSetting->exam_type)
                     ->where('exam_category', $examSetting->exam_category)
                     ->where('no_of_qst', $examSetting->no_of_qst)
                     ->where('question_no', $cbtEvaluation);
    }
    
}
