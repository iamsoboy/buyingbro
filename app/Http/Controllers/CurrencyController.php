<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function set(Request $request)
    {
        if($request->get('currency')){
            currency()->setUserCurrency($request);
        }
        return back();
    }
}
