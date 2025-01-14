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
        'upload_no_of_qst',
        'no_of_qst',
        'level',
        'duration',
        'exam_type',
        'exam_category',
        'exam_status',
        'exam_date',
        'exam_mode',
        'course',
        'check_result',
        'semester',
        'lock_status',
        'exam_view_type',
    ];
}
