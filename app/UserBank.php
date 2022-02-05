<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserBank extends Model
{
    protected $fillable = [
        'user_id', 'account_name', 'account_number', 'bank_name', 'recipient_code'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
