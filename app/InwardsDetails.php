<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InwardsDetails extends Model
{
    protected $table = 'inwards_details';

    protected $fillable = [
        'academicyear','fromtitle','referencenumber','fromaddress','totitle','postaldate','filename',
    ];
}
