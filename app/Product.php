<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Product extends Model
{
    protected $fillable = [
        'brand_id', 'name', 'type', 'status', 'price', 'value'
    ];

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function presentDiscount()
    {
        $discount = ((($this->value - $this->price) / $this->value) * 100);
        return number_format($discount, 2, '.', ',');
    }

    public function getTypeAttribute($value)
    {
        if ($value == 0)
        return 'Physical Card';
        else
        return 'Electronic Card';
        /*([
            0 => 'Physical Card',
            1 => 'Electronic Card'
        ])[$value];*/
    }

}
