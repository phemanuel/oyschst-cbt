<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'login_attempts',
        'email_verified_status',
        'user_type',
        //--Exam Setting
        'exam_setting',
        'edit_exam_setting',
        //-Question bank------
        'qst_bank',
        'create_question_bank',
        'edit_question_bank',
        //----student list/upload---
        'std_list',
        'create_std_list',
        'edit_std_list',
        'delete_std_list',
        //----student login status----
        'std_login_status',
        'edit_std_login_status',
        //--change course---
        'change_course',
        'edit_change_course',
        //----User create---
        'user_create',
        'create_user_create',
        'edit_user_create',
        'status_user_create',
        //---college setup----
        'college_setup',
        'create_college_setup',
        'edit_college_setup',
        'delete_college_setup',
        //---report
        'report',
        'check_report',
        'export_report',
        //---user status
        'user_status',
        
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
}
