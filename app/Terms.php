<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Terms extends Model
{
    protected $fillable = [

        'title','excerpt', 'body', 'image','slug','meta_description', 'meta_keyword', 'status', 'reference',

    ];

    protected $table = 'pages';
}
