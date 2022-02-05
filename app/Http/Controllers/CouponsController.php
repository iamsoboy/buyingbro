<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;
use Gloudemans\Shoppingcart\Facades\Cart;



class CouponsController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$item = Cart::instance('default')->setGlobalDiscount(30);
        //dd(Cart::instance('default'), Cart::content(), Cart::discount());
        
        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if(!$coupon){
            return redirect()->route('cart.index')->withErrors('Invalid coupon code. Please try again.');
        }

        
       Cart::setDiscount($rowId, $coupon->discounted(Cart::subtotal()));
        //dd($realdiscount);
        session()->put('coupon', [
            'name' => $coupon->code,
        ]);

        return redirect()->route('cart.index')->with('success_message', 'Coupon has been applied!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        session()->forget('coupon');
        return redirect()->route('cart.index')->with('success_message', 'Coupon has been removed!');
    }
}
