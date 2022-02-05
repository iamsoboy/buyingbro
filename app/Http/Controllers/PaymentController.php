<?php

namespace App\Http\Controllers;

use App\Notifications\depositError;
use App\Notifications\depositSuccessful;
use App\Order;
use App\OrderProduct;
use App\Product;
use App\UserDeposit;
use Checkout\Library\Exceptions\CheckoutHttpException;
use Checkout\Library\Exceptions\CheckoutModelException;
use Checkout\Models\Address;
use Checkout\Models\Payments\BillingDescriptor;
use Checkout\Models\Payments\Customer;
use Checkout\Models\Payments\Risk;
use Checkout\Models\Payments\Shipping;
use Checkout\Models\Payments\ThreeDs;
use Checkout\Models\Phone;
use Checkout\tests\Helpers\Tokens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Unicodeveloper\Paystack\Facades\Paystack;
use Checkout\CheckoutApi;
use Checkout\Models\Tokens\Card;
use Checkout\Models\Payments\TokenSource;
use Checkout\Models\Payments\Payment;
use Validator;
use function React\Promise\all;

class PaymentController extends Controller
{
    /**
     * Redirect the User to Paystack Payment Page
     * @param Request $request
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'zipcode' => 'required|string',
            'state' => 'required|string',
            'country' => 'required|string',
            'payment_method' => 'required|numeric',
        ]);

        $user = Auth::user();

        $amount = (str_replace(',', '', Cart::instance('default')->total()) * 100);

        $array = [ 'custom_fields' => [
            ['display_name' => "Zip Code", "variable_name" => "postalcode", "value" => "$request->zipcode"],
            ['display_name' => "Address", "variable_name" => "address", "value" => "$request->address"],
            ['display_name' => "State", "variable_name" => "state", "value" => "$request->state"],
            ['display_name' => "Country", "variable_name" => "country", "value" => "$request->country"],
                                      ]

                ];

        $request->request->add([
            'first_name' => $request->name ? $request->name : $user->name,
            'email' => $request->email ? $request->email : $user->email,
            'amount' => $amount,
            'quantity' => 1,
            'metadata' => $array,
        ]);

        dd($request->all(), Cart::content());
        try{
            return Paystack::getAuthorizationUrl()->redirectNow();
        }catch(\Exception $e) {
            return Redirect::back()->withMessage(['msg'=>'The paystack token has expired. Please refresh the page and try again.', 'type'=>'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback()
    {
        $user = Auth::user();

        $paymentDetails = Paystack::getPaymentData();


        //dd($paymentDetails);
        // Now you have the payment details,
        // you can store the authorization_code in your db to allow for recurrent subscriptions
        // you can then redirect or do whatever you want

        // IF PAYMENT IS SUCCESSFUL
        if($paymentDetails['data']['metadata']['custom_fields']['0']['value'] == "deposit") {

            if($paymentDetails['data']['status']== "success"){

                $deposit = UserDeposit::create([

                    'transaction_id' => $paymentDetails['data']['reference'],
                    'gateway_name' => "Paystack",
                    'amount' => $paymentDetails['data']['metadata']['custom_fields']['2']['value'],
                    'details' => "No Deposit Details",
                    'charge' => $paymentDetails['data']['metadata']['custom_fields']['1']['value'],
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'status' => 1,
                    'net_amount' => ($paymentDetails['data']['amount'] / 100),

                ]);

                $user->userprofile->deposit_balance = $user->userprofile->deposit_balance + $paymentDetails['data']['metadata']['custom_fields']['2']['value'];
                $user->userprofile->save();

                Notification::send($user, new depositSuccessful($deposit));

                return redirect()->route('deposithistory.show', [$user])->with('success_message', 'Your Deposit request is successfully');

            } else{

                Notification::send($user, new depositError($deposit));

                return redirect ('user/deposit')->withErrors('Oops, something went wrong!');
            }
        }

        if($paymentDetails['data']['status'] == "success"){

            $gateway = 'Paystack';

            $this->addToOrdersTables($paymentDetails, $gateway);

            return redirect()->route('checkout.show', $paymentDetails['data']['reference'])->with('success_message', 'Your Payment was successful!');

        } else {

            return back()->with('errors', 'Oops! Your payment was unsuccessful.');
        }
    }

    public function redirectToCheckoutGateway(Request $request)
    {
        $user = Auth::user();
        $validator = Validator::make($request->all(), [
            'card_no' => 'required',
            'exp_month' => 'required',
            'exp_year' => 'required',
            'cvv' => 'required',
            'amount' => 'required',
        ]);

        $input = $request->all();

        if ($validator->passes()) {
            $input = \Arr::except($input, array('_token'));

            // Set the secret key
            $secretKey = env('CHECKOUT_SECRET_TEST');
            $publicKey = env('CHECKOUT_PUBLIC_TEST');

            // Initialize the Checkout API in Sandbox mode. Use new CheckoutApi($liveSecretKey, false); for production
            $checkout = new CheckoutApi($secretKey, true, $publicKey);

            $card = new Card($request->get('card_no'), $request->get('exp_month'), $request->get('exp_year'), $request->get('cvv'));
            $card->name = $user->name;

            $tokenData = $checkout->tokens()->request($card);

            //dd($tokenData, $tokens, $tokenData->token);

            $method = new TokenSource($tokenData->token);
            $payment = new Payment($method, 'NGN');

            $customer = new Customer();
            $customer->email = 'john.smith@email.com';
            $customer->name = 'John Smith';

            $address = new Address();
            $address->address_line1 = '14-17 Wells Mews';
            $address->address_line2 = 'Fitzrovia';
            $address->city = 'London';
            $address->state = 'London';
            $address->zip = 'W1T 3HF';
            $address->country = 'UK';

            $phone = new Phone();
            $phone->country_code = '0044';
            $phone->number = '02073233888';

            $payment->shipping = new Shipping($address, $phone);
            $payment->billing_descriptor = new BillingDescriptor("Dynamic desc charge", "City charge");
            $payment->amount = $request->get('amount');
            $payment->capture = true;
            $payment->reference = 'ORD-090874';
            $payment->threeDs = new ThreeDs(true);
            $payment->risk = new Risk(true);
            //$payment->setIdempotencyKey(createMyUniqueKeyForThis());

            try {
                $details = $checkout->payments()->request($payment);
                //$webhooks = $checkout->webhooks()->retrieve();

                //return redirect()

                //dd($details, $details->_links['redirect']['href']);

                $redirection = $details->getRedirection();
                if ($redirection) {
                    return redirect ($redirection);
                   // return $redirection;
                }

                return $details;
            } catch (CheckoutModelException $ex) {
                return $ex->getErrors();
            } catch (CheckoutHttpException $ex) {
                return $ex->getErrors();
            }

            /**
             * try {
             *
             * $token = $checkout->tokens([
             * 'card' => [
             * 'number' => $request->get('card_no'),
             * 'exp_month' => $request->get('exp_month'),
             * 'exp_year' => $request->get('exp_year'),
             * 'cvc' => $request->get('cvv'),
             * ],
             * ]);
             *
             * public static function generateID()
             * {
             * return 'tok_' . substr(md5(rand()), 0, 26);
             * }
             *
             * public static function generateCardModel()
             * {
             * $card = new Card('4242424242424242', 01, 2025);
             * $card->cvv = 100;
             * $card->name = 'Joe Smith';
             *
             * return $card;
             * }
             *
             *
             * $token = $request->get('tok_ubfj2q76miwundwlk72vxt2i7q');
             * // Create a payment method instance with card details
             * $method = new TokenSource($token);
             *
             * //dd($input, $secretKey, $checkout, $method);
             *
             * // Prepare the payment parameters
             * $payment = new Payment($method, 'NGN');
             * $payment->amount = 1000; // = 10.00
             *
             * //dd($payment);
             *
             * // Send the request and retrieve the response
             * $response = $checkout->payments()->request($payment);
             *
             * dd($response, $payment);
             * } catch (Exception $e) {
             * \Session::put('error',$e->getMessage());
             * return redirect()->route('stripform');
             * }
             * }
             * **/
        }

    }



    protected function addToOrdersTables($paymentDetails, $gateway)
    {
        $user = Auth::user();

        $order = Order::create([

            'user_id' => $user->id ? $user->id : null,
            'billing_name' => $paymentDetails['data']['customer']['first_name'] ? $paymentDetails['data']['customer']['first_name'] : $user->name,
            'billing_email' => $paymentDetails['data']['customer']['email'] ? $paymentDetails['data']['customer']['email'] : $user->email,
            'billing_phone' => $paymentDetails['data']['customer']['phone'] ? $paymentDetails['data']['customer']['phone'] : $user->userprofile->mobile,
            'billing_address' => $paymentDetails['data']['metadata']['custom_fields']['1']['value'] ? $paymentDetails['data']['metadata']['custom_fields']['1']['value'] : $user->userprofile->address,
            'billing_state' => $paymentDetails['data']['metadata']['custom_fields']['2']['value'] ? $paymentDetails['data']['metadata']['custom_fields']['2']['value'] : $user->userprofile->state,
            'billing_country' => $paymentDetails['data']['metadata']['custom_fields']['3']['value'] ? $paymentDetails['data']['metadata']['custom_fields']['3']['value'] : $user->userprofile->country,
            'billing_postalcode' => $paymentDetails['data']['metadata']['custom_fields']['0']['value'] ? $paymentDetails['data']['metadata']['custom_fields']['0']['value'] : $user->userprofile->postcode,
            'billing_transaction_id' => $paymentDetails['data']['reference'],
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

            $products = Product::find($item->model->id);

            if ($products->name !== "MyBux Vouchers") {
                Product::where('id', $item->model->id)->update(array('status' => 0));
            }
        }


        Cart::instance('default')->destroy();
    }
}
