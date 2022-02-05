<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Crypt;
use App\Brand;
use App\Product;

class WishlistController extends Controller
{
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cartId = Crypt::decrypt($id);

        Cart::instance('wishlist')->remove($cartId);

        return back()->with('success_message', 'Item has been removed!');
    }

    /**
     * Move item back to cart.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function wishlistToCart($id)
    {
        $cartId = Crypt::decrypt($id);

        $item = Cart::instance('wishlist')->get($cartId);

        Cart::instance('wishlist')->remove($cartId);

        $duplicates = Cart::instance('default')->search(function ($cartItem, $rowId) use ($cartId) {
            return $cartItem->id === $item->id;
        });

        if($duplicates->isNotEmpty())
        {
            return redirect()->route('cart.index')->with('message', 'Item is already in Cart!');
        }

        Cart::instance('default')->add($item->id, $item->name, 1, $item->price, 0, ['discount' => $item->options['discount'], 'type' => $item->options['type']])
            ->associate('App\Product');
        
        return redirect()->route('cart.index')->with('success_message', 'Item have been moved to cart!');
    }
}
