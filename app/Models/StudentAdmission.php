<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAdmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'admission_no', 
        'first_name', 
        'surname', 
        'department', 
        'other_name', 
        'phone_no', 
        'state', 
        'level', 
        'sex', 
        'phone_no1',
        'user_name', 
        'picture_name', 
        'session1', 
        'login_status',
        'email',
    ];
}
