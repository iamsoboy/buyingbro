<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSupport extends Model
{
    //
    protected $fillable = [
        'user_id', 'subject', 'message','ticket','status',
    ];


    public function getStatusAttribute($attribute)
    {
        return[
            0 => 'Closed',
            1 => 'Active',
            2 => 'Customer Care Replied'
        ] [$attribute];
    }

    public function user(){

        return $this->belongsTo('App\User');

    }

    public function discussions(){

        return $this->hasMany('App\Discussion');

    }


}
