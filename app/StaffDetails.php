<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffDetails extends Model
{
    protected $table = 'staff_details';

    protected $fillable = [
        'userid','staffid','staffrole','designation','fname','mname','lname','mothername','gender','dob', 'email','mobile','bloodgroup',
        'maritalstatus','religion','category','castename','subcaste','aadhar','mothertongue','placeob','joiningdate','shalarthid',
        'staffphoto','qualificationdetails','experiencedetails','currentaddress','permanentaddress',
    ];
}
