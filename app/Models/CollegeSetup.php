<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeSetup extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'avatar',
        'address',
        'phone',
        'email',
        'web_url',
    ];
}
