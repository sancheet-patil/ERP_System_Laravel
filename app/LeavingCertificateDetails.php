<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LeavingCertificateDetails extends Model
{
    protected $table = 'leaving_certificate_details';

    protected $fillable = [
        'academicyear','studentid','progress','conduct','dateofleaving','reasonofleaving','remarks','studyinginclass','issuedate',
        'printcount',
    ];
}
