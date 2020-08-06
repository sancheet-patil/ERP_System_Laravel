<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StudentOtherDetails extends Model
{
    protected $table = 'student_other_details';

    protected $fillable = [
        'userid','fathername','fatherphone','fatheroccupation','mothername','motherphone','motheroccupation','guardianname',
        'guardianphone','guardianrelation','guardianoccupation','guardianaddress','document1name','document1file','document2name',
        'document2file','document3name','document3file','document4name','document4file','document5name','document5file',
        'document6name','document6file','accounttitle','accountno','bankifsccode','bankname','bankbranchname','bankmicrcode',
    ];
}
