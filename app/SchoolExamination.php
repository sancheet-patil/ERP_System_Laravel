<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolExamination extends Model
{
    protected $table = 'school_examinations';

    protected $fillable = [
        'academicyear','classname','division','semester','studentid','subjectname','marks','specialremarks','hobbies',
        'otherremarks',
    ];
}
