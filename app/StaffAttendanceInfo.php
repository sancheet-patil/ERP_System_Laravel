<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffAttendanceInfo extends Model
{
    protected $table = 'staff_attendance_infos';

    protected $fillable = [
        'academicyear','attendancedate','staffid','ispresent',
    ];
}
