<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDeposit extends Model
{
    //
    protected $fillable = [
        'transaction_id', 'user_id', 'gateway_name','amount','charge','net_amount','status','details', 'name'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
    public function getStatusAttribute($attribute)
    {
        return[
            0 => 'Pending',
            1 => 'Successful',
            2 => 'Successful'
        ] [$attribute];
    }

    public function setStatusAttribute($attribute)
    {
        return[
            'Pending' => 0,
            'Successful' => 1,
            'Failed' => 2
        ] [$attribute];
    }
    */
}
