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
        'class', 
        'subject1', 
        'subject2', 
        'subject3', 
        'subject4', 
        'subject5', 
        'session1', 
        'semester', 
        'department', 
        'exam_type', 
        'time_limit', 
        'no_of_qst'
    ];
}
