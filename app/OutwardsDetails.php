<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutwardsDetails extends Model
{
    protected $table = 'outwards_details';

    protected $fillable = [
        'academicyear','totitle','referencenumber','toaddress','fromtitle','postaldate','filename',
    ];
}
