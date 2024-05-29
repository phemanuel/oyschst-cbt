<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSetting extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'exam_settings';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'level', 
        // 'subject1', 
        // 'subject2', 
        // 'subject3', 
        // 'subject4', 
        // 'subject5', 
        'session1', 
        'semester', 
        'department', 
        'exam_type', 
        'exam_category',
        'exam_mode', 
        'time_limit', 
        'no_of_qst',
        'upload_no_of_qst',
        'course',
        'duration', 
        'check_result',
    ];
}
