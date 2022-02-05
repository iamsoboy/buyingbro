<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Gateway;
use App\Order;
use App\Product;
use App\Userprofile;
use App\OrderProduct;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $referenceCode = Str::random(13);
        $gateways = Gateway::whereStatus(1)->get();
        //dd($gateways);

        return view('checkout.index', compact('user', 'referenceCode', 'gateways'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function wallet(Request $request)
    {
        $rules = [
            'refid' => ['required', 'alpha_num', 'min:13', 'max:13'],
        ];

        $customMessages = [
            'refid.required' => 'Oops. Something went wrong. Try again.',
            'refid.alpha_num' => 'Oops. Something went wrong. Try again.',
            'refid.max' => 'Oops. Something went wrong. Try again.',
            'refid.min' => 'Oops. Something went wrong. Try again.',
        ];

        $this->validate($request, $rules, $customMessages);

        $user = Auth::user();

        $total = unset_number(Cart::instance('default')->total());

        if($user->userprofile->deposit_balance < $total){
            return redirect()->route('checkout.index')->withErrors('You do not have enough funds! Kindly <a href="/user/deposit">FUND </a> your wallet.');
        }

        $gateway = 'Wallet';

        $this->addToOrdersTables($request, $gateway);

        $balance = $user->userprofile->deposit_balance - $total;
        $profile = $user->userprofile;
        $profile->deposit_balance = $balance;
        $profile->save();


        return redirect()->route('checkout.show', [$request->refid])->with('success_message', 'Your Payment was successful!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!session()->has('success_message'))
        {
            return redirect('/');
        }

        return view('checkout.show', compact('id'));
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    protected function addToOrdersTables($request, $gateway)
    {
            $user = Auth::user();
            $order = Order::create([

                'user_id' => $user->id ? $user->id : null,
                'billing_name' => $request->name ? $request->name : $user->name,
                'billing_email' => $request->email ? $request->email : $user->email,
                'billing_phone' => $request->phone ? $request->phone : $user->userprofile->mobile,
                'billing_address' => $request->address ? $request->address : $user->userprofile->address,
                'billing_state' => $request->state ? $request->state : $user->userprofile->state,
                'billing_country' => $request->country ? $request->country : $user->userprofile->country,
                'billing_postalcode' => $request->zipcode ? $request->zipcode : $user->userprofile->postcode,
                'billing_transaction_id' => $request->refid,
                'billing_subtotal' => str_replace(',', '', Cart::instance('default')->subtotal()),
                'payment_status' => 1,
                'payment_method' => $gateway,
                'billing_total' => str_replace(',', '', Cart::instance('default')->total()),
                'shipping_fee' => 0,
                'shipped' => 1,
                'billing_tax' => Cart::instance('default')->tax()

            ]);

            //INSERT INTO ORDER_PRODUCT TABLE
            foreach (Cart::content() as $item) {

                OrderProduct::create([
                    'order_id' => $order->id,
                    'product_id' => $item->model->id,
                    'quantity' => $item->qty
                ]);

                //$products = Product::find($item->model->id);
                Product::where('id', $item->model->id)->update(array('status' => 1));
            }


            Cart::instance('default')->destroy();
    }
}
