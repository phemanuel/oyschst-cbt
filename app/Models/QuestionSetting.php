<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'session1',
        'department',
        'no_of_qst',
        'level',
        'duration',
        'exam_type',
        'exam_category',
        'exam_status',
        'exam_date',
        'exam_mode',
    ];
}
