<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use Cartalyst\Stripe\Exception\CardErrorException;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use App\User;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Cartalyst\Stripe\Api\PaymentIntents;

class StripeController extends Controller
{
    public function payWithStripe()
    {
        return view('stripe');
    }

    public function postPaymentWithStripe(Request $request)
    {
        // $this->validate($request, [
        //     'name' => 'required|string',
        //     'address' => 'required|string',
        //     'email' => 'required|email',
        //     'phone' => 'required|string|max:20',
        //     'zipcode' => 'required|string',
        //     'state' => 'required|string',
        //     'country' => 'required|string',
        //     'payment_method' => 'required|numeric',
        //     'name_on_card' => 'required|string',
        //     'stripeToken' => 'required|string'
        // ]);

        //dd($request->all());

        $user = Auth::user();
        $amount = (str_replace(',', '', Cart::instance('default')->total()));
        $currency = currency()->getUserCurrency();

        $stripe = Stripe::make('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');

        try {

            $charge = $stripe->charges()->create([
                'currency' => 'usd', //$currency,
                'amount'   => 55, //$amount,
                'source' => $request->stripeToken,
                'description' => "Order",
                'capture' => true,
                // Verify your integration in this guide by including this parameter
                'metadata' => [
                    'integration_check' => 'accept_a_live_payment',
                    'Quantity' => Cart::instance('default')->count(),
                ],
            ]);

            dd($charge);

            //IF SUCCESSFUL
            $this->addToOrdersTables($charge);

            return redirect()->route('checkout.show', $charge['balance_transaction'])->with('success_message', 'Your Payment was successful!');


        } catch (CardErrorException $e) {
            return back()->withErrors('Error! '. $e->getMessage());
        }
    }

    protected function addToOrdersTables($charge)
    {
        $user = Auth::user();

        $order = Order::create([

            'user_id' => $user->id ? $user->id : null,
            'billing_name' => $charge['billing_details']['name'] ? $charge['billing_details']['name'] : $user->name,
            'billing_email' => $user->email,
            'billing_phone' => $user->userprofile->mobile,
            'billing_address' => $user->userprofile->address,
            'billing_state' => $user->userprofile->state,
            'billing_country' => $user->userprofile->country,
            'billing_postalcode' => $user->userprofile->postcode,
            'billing_transaction_id' => $charge['balance_transaction'],
            'billing_subtotal' => str_replace(',', '', Cart::instance('default')->subtotal()),
            'payment_status' => 1,
            'payment_method' => "Stripe",
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

            $products = Product::find($item->model->id);

            if ($products->name !== "MyBux Vouchers") {
                Product::where('id', $item->model->id)->update(array('status' => 0));
            }
        }


        Cart::instance('default')->destroy();
    }
}
