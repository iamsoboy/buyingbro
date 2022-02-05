<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Testimonial extends Model
{
    protected $fillable = [
        'name', 'title', 'comment', 'image','ticket','status'
    ];

    public function userprofile(){

        return $this->belongsTo('App\UserProfile');

    }
    
}
