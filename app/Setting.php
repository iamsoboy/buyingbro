<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Setting extends Model
{
    protected $fillable = [
        'site_name'.'card_percent', 'coin_percent','bitcoin','ethereum','site_title', 'company_name', 'contact_email', 'contact_number','address', 'payment_proof', 'latest_deposit','minimum_deposit','minimum_withdraw',
        'self_transfer','other_transfer','live_chat','chat_code',
        'status', 'minimum_transfer','login',
    ];
}
