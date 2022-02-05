<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AvailableCards extends Model
{
    protected $fillable = [
        'name', 'percentage', 'type', 'currency', 'status', 'note',
    ];
}
