<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsLists extends Model
{
    protected $table = 'events_lists';

    protected $fillable = [
        'edate','ename','etime','details',
    ];
}
