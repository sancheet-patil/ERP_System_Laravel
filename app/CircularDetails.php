<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CircularDetails extends Model
{
    protected $table = 'circular_details';

    protected $fillable = [
        'academicyear','circulardate','contenttitle','contenttype','availablefor','description','contentpath',
    ];
}
