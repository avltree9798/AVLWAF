<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BillableAction extends Model
{
    protected $fillable = [
        'rule_id',
        'blacklist_id',
        'hacking_attempt_id',
        'user_id',
        'amount'
    ];
}
