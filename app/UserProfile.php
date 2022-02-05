<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    //
    protected $fillable = [
        'user_id',
        'avatar',
        'mobile',
        'address',
        'city',
        'state',
        'postcode',
        'country',
        'main_balance',
        'deposit_balance',
        
    ];

    public function user()
    {

        return $this->belongsTo('App\User');
    }

    public function discussions(){

        return $this->hasMany('App\Discussion');

    }

    public function testimonial(){

        return $this->hasMany('App\Testimonial');

    }
    
    /*
    public function getAvatarAttribute($avatar){

        return asset($avatar);

    }
*/
}
