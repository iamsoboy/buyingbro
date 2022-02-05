<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'billing_transaction_id','billing_name', 'billing_address', 'billing_country', 'billing_state', 'billing_postalcode', 'billing_phone', 'payment_method','billing_email','shipped','billing_discount','shipping_fee','billing_total','billing_tax','billing_subtotal'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsToMany('\App\Product')->withPivot('quantity');
    }

    public function orderproducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function getShippedAttribute($attribute)
    {
        return ([
            0 => 'Pending',
            1 => 'Delivered',
        ])[$attribute];
    }
}
