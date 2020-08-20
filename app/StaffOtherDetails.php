<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StaffOtherDetails extends Model
{
    protected $table = 'staff_other_details';

    protected $fillable = [
        'userid','epfno','basicsalary','contracttype','seniorscale','mostseniorscale','accounttitle','accountno','bankifsccode',
        'bankname','bankbranchname','bankmicrcode','salarytitle','salaryaccountno','salaryifsc','salarybank','salarybranch','salarymicr',
        'pensiontitle','pensionaccountno','pensionifsc','pensionbank','pensionbranch','pensionmicr',
        'document1name','document1file','document2name','document2file','document3name','document3file',
        'document4name','document4file','document5name','document5file','document6name','document6file',
    ];
}
