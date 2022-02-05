<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserWithdraw extends Model
{
    //
    protected $fillable = [
        'reference', 'user_id', 'method','amount','charge','net_amount','status','details', 'name', 'transfer_code'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /*
    public function getStatusAttribute($attribute)
    {

        if ($attribute == 0)
        return 'Pending';
        elseif ($attribute == 1)
        return 'Successful';
        else
        return 'Failed';


        return[
            0 => 'Pending',
            1 => 'Successful',
            2 => 'Failed'
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
