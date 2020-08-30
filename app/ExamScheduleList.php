<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExamScheduleList extends Model
{
    protected $table = 'exam_schedule_lists';

    protected $fillable = [
        'examtype','classname','faculty','subjectname','passingmarks','outofmarks',
    ];
}
