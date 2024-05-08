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
        'questionno', 
        'noofquestion', 
        'session1', 
        'department', 
        'subject', 
        'uploadnoofquestion', 
        'class', 
        'minute', 
        'examtype', 
        'questiontype', 
        'answer', 
        'question', 
        'graphic'
    ];
}
