<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolInfos extends Model
{
    protected $table = 'school_infos';

    protected $fillable = [
        'schoolname','address','taluka','district','email','phone','faxnumber','website','estbdate','devname','devurl','maxlc',
    ];
}
