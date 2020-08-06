<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassTeacherDetails extends Model
{
    protected $table = 'class_teacher_details';

    protected $fillable = [
        'academicyear','classname','division','teacherid',
    ];
}
