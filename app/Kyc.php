<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kyc extends Model
{
    //
    protected $fillable = [

        'name', 'user_id', 'number','front','back','expiry_date','status',

    ];
    public function user(){

        return $this->belongsTo('App\User');

    }
    public function getFrontAttribute($front){

        return asset($front);

    }
    public function getBackAttribute($back){

        return asset($back);

    }
}
