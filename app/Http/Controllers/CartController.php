<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Crypt;
use App\Product;
use Illuminate\Support\Str;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('cart.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'id' => 'required|string',
        ]);

        try {

            $productId = Crypt::decrypt($request->id);

            $product = Product::whereId($productId)->first();

            if($product->id == 11) {
                $this->validate($request, [
                    'amount' => 'required|numeric',
                    'telephone' => 'required|regex:/^\+?\d{2,3} ?\d{2,3} ?\d{2,3} ?\d{2,4}$/|min:10|max:20',
                ]);

                $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
                    return $cartItem->id === $product->id;
                });

                if ($duplicates->isNotEmpty()) {
                    return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
                }

                Cart::add($product->id, $product->name, 1, $request->amount, 0,
                    ['discount' => 0,
                    'type' => $product->type,
                    'phone' => $request->telephone])->associate('App\Product');

                return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');
            }



            $duplicates = Cart::search(function ($cartItem, $rowId) use ($product) {
                return $cartItem->id === $product->id;
            });

            if ($duplicates->isNotEmpty()) {
                return redirect()->route('cart.index')->with('success_message', 'Item is already in your cart!');
            }

            Cart::add($product->id, $product->name, 1, $product->price, 0, ['discount' => $product->presentDiscount(), 'type' => $product->type])
                ->associate('App\Product');

            return redirect()->route('cart.index')->with('success_message', 'Item was added to your cart!');

        } catch (DecryptException $e) {
            return back()->withErrors('Oops! Something went wrong, Try Again.');
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        try {
        $cartId = Crypt::decrypt($id);

        Cart::remove($cartId);

        return back()->with('success_message', 'Item has been removed!');

        } catch (DecryptException $e) {
            return back();
        }
    }

    /**
     * Add the specified resource to Wishlist.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wishlist($id)
    {
        try {
            $cartId = Crypt::decrypt($id);

            $item = Cart::instance('default')->get($cartId);

            Cart::instance('default')->remove($cartId);

            $duplicates = Cart::instance('wishlist')->search(function ($cartItem, $rowId) use ($item) {
                return $cartItem->id === $item->id;
            });

            if ($duplicates->isNotEmpty()) {
                return redirect()->route('cart.index')->with('message', 'Item is already been Saved For Later!');
            }

            Cart::instance('wishlist')->add($item->id, $item->name, 1, $item->price, 0, ['discount' => $item->options['discount'], 'type' => $item->options['type']])
                ->associate('App\Product');

            return redirect()->route('cart.index')->with('message', 'Item has been Saved for Later');

        } catch (DecryptException $e) {
            return back();
        }
    }
}
