<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentAttendanceInfo extends Model
{
    protected $table = 'student_attendance_infos';

    protected $fillable = [
        'academicyear','attendancedate','classname','division','faculty','studentid','ispresent',
    ];
}
