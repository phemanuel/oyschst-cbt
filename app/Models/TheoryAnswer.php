<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TheoryAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'examstatus', 'studentname', 'studentno','exam_date', 'hour', 'minute',
        'question_no', 
        'no_of_qst', 
        'session1', 
        'department',
        'upload_no_of_qst', 
        'level',
        'exam_type', 
        'exam_category',
        'exam_mode',
        'course',
        'semester',
        'total_score',
        'A1', 'A2', 'A3', 'A4', 'A5', 'A6', 'A7', 'A8','A9','A10',
        'Q1', 'Q2', 'Q3', 'Q4', 'Q5', 'Q6', 'Q7', 'Q8', 'Q9', 'Q10',
        'ANS1', 'ANS2', 'ANS3', 'ANS4', 'ANS5', 'ANS6', 'ANS7', 'ANS8', 'ANS9', 'ANS10',
		'score1', 'score2', 'score3', 'score4', 'score5', 'score6', 'score7', 'score8', 'score9', 'score10',
        'QT1', 'QT2', 'QT3', 'QT4', 'QT5', 'QT6', 'QT7', 'QT8', 'QT9', 'QT10',
		'G1', 'G2', 'G3', 'G4', 'G5', 'G6', 'G7', 'G8', 'G9', 'G10','grading_status',
    ];
}
