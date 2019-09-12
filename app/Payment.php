<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $dates = [
        'start_date',
        'end_date'
    ];

    protected $fillable = [
        'start_date',
        'end_date',
        'amount',
        'user_id',
        'remark'
    ];
}
