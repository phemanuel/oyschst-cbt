<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CbtEvaluation1 extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cbt_evaluation1';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'examid', 'examstatus', 'studentname', 'correct', 'noofquestion', 'wrong', 'studentno', 'course' ,
        'score',  'level', 'session1', 'semester','hour', 'minute', 'qstno',
        'OK1', 'OK2', 'OK3', 'OK4', 'OK5', 'OK6', 'OK7', 'OK8','OK9','OK10','OK11','OK12','OK13','OK14','OK15','OK16','OK17',
        'OK18','OK19','OK20','OK21','OK22','OK23','OK24','OK25','OK26','OK27','OK28','OK29','OK30','OK31','OK32','OK33','OK34','OK35','OK36','OK37','OK38',
        'OK39','OK40','OK41','OK42','OK43','OK44','OK45','OK46','OK47','OK48','OK49','OK50','OK51','OK52','OK53','OK54',
        'OK55','OK56','OK57','OK58','OK59','OK60','OK61','OK62','OK63','OK64','OK65','OK66','OK67','OK68','OK69','OK70','OK71',
        'OK72','OK73','OK74','OK75','OK76','OK77','OK78','OK79','OK80','OK81','OK82','OK83','OK84','OK85','OK86','OK87',
        'OK88','OK89','OK90','OK91','OK92','OK93','OK94','OK95','OK96','OK97','OK98','OK99','OK100',
        'department', 'examdate', 'exam_type', 'msgstatus', 'starttime', 'endtime','exam_mode','exam_category'
    ];
}
