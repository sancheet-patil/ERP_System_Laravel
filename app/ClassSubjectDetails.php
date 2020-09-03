<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClassSubjectDetails extends Model
{
    protected $table = 'class_subject_details';

    protected $fillable = [
        'academicyear','classname','division','faculty','subjectname','outofmarks','teachername',
    ];
}
