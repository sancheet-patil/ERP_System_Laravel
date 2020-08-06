<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentDetails extends Model
{
    protected $table = 'student_details';

    protected $fillable = [
        'userid','academicyear','registerfor','faculty','classname','division','registerno','admission_date','admission_class','saralid','roll_no','fname','mname',
        'lname','gender','dob','religion','category','castename','subcaste','mobile','email','aadhar','placeob','mothertongue','bloodgroup',
        'pwd','schoolname','lastschool','lastclass','studentphoto','admissiontype','lateadmission','hostelrequired','citytype',
        'previouslcno','previousgrno','currentaddress','permanentaddress','status','hasaccess',
    ];
}
