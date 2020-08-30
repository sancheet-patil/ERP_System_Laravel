<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamEvaluationDetails extends Model
{
    protected $table = 'exam_evaluation_details';

    protected $fillable = [
        'academicyear','studentid','classname','division','faculty','examtype','subjectname','passingmarks','outofmarks','obtainedmarks',
    ];
}
