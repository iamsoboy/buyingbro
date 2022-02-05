<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Gateway extends Model
{
    //
    protected $fillable = [

        'name', 'image', 'account','fixed','percent','mode','public_key','secret_key','callback_url','details','status',
    ];

    public function getFeaturedAttribute($image){

        return asset($image);

    }
    public function cryptos(){

        return $this->hasMany('App\Crypto');

    }

}
