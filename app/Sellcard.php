<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Sellcard extends Model
{
    //
    protected $fillable = [

        'name','value', 'user_id', 'front','back','description','status', 'reference',

    ];

    public function getStatusAttribute($attribute)
    {
        return[
            0 => 'Pending',
            1 => 'Successful'
        ] [$attribute];
    }
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
