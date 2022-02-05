<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankDetail extends Model
{
    protected $fillable = [
        'name', 'bankcode', 'country', 'currency', 'type', 'active'
    ];
}
