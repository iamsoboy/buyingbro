<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderProduct;
use App\Product;
use App\Wallettec;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class WallettecController extends Controller
{
    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function buyMyBux(Request $request)
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

        $product = Cart::content()->map(function ($item){
            return $data = ['id' => $item->rowId,
                            'name' => $item->name,
                            'qty' => $item->qty,
                            'phone' => $item->options['phone'], ];
        })->values()->toArray();

        $amount = str_replace(',', '', Cart::instance('default')->total());

        $fields = [
           'amount' => $amount,
           'phonenumber' => $product['0']['phone'],
           'reason' => "Deposit",
           'success_message' => "Deposit Successfully",
           'transactionId' => Str::random('14'),
           'walletRequiredInfo' => [
               'id' => Str::random('6'),
               'description' => "Email is required",
           ],
           'ip' => $this->request->ip(),
           'notificationUrl' => "https://buyingbro.com/mybux/callback",
           'email' => "iamsoboy@gmail.com", //$user->email ? $user->email : $request->email,
           'receipt' => "iamsoboy@gmail.com", //$user->email ? $user->email : $request->email,
           'prodList' => [
               'itemCode' => Str::random('7'), //$product['0']['id'],
               'quantity' => 1, //$product['0']['qty'],
               'price' => $amount,
               'description' => "Account Deposit", //$product['0']['name'],
           ],
       ];

        $response = requestPayment($fields);

        $params = $response->json();

        //dd($params);
        if($response->ok() == "true"){
            if(isset($response->json()['paymentInstructionRedirectUrl']))
                return view('checkout.wallettec', compact('params'));
            //redirect($response->json()['paymentInstructionRedirectUrl']);
            else {
                return Redirect::back()->withErrors('Oops Something went wrong!');
            }

            //view('checkout.wallettec', compact('details'));
                //redirect()->route('buyMyBuxPaymentInstructions', [$fields['transactionId']])
                    //->with('fields', $fields);
            //return

        } else {
            return Redirect::back()->withErrors(['msg'=>$response->json()['errorReason'], 'type'=>'error']);
        }
        //dd($response, $response->body(), $response->json(), $response->ok(), $response->serverError(), $response->clientError(), $request->all(), $fields);
    }

    public function buyMyBuxPaymentInstructions()
    {
        return view('checkout.wallettec');
    }

    public function getStatus(Request $request)
    {
        $response = getPaymentStatus($request->id);

        $data =  $response->json();

        //dd($data);

        //IF SUCCESSFUL
        if($response->ok() == "true") {

            if (isset($response->json()['gatewaytransid'])) {

                $this->addToOrdersTables($data);

                return redirect()->route('checkout.show', $data['gatewaytransid'])->with('success_message', 'Your Payment was successful!');

            } else {
                return redirect()->route('checkout.index')->withErrors('Payment attempt failed, please try again');
            }
        } else {
            return redirect()->route('checkout.index')->withErrors('Payment attempt failed, please try again');
        }

        dd($response, $response->json());
    }

    public function issueVoucher(Request $request)
    {
        $user = Auth::user();

        $fields = [
            'email' => "iamsoboy@gmail.com",
            'mobilenumber' => "+2348062177314",
            'transactionAmount' => "1000",
            'transactionId' => Str::random(14),
            'transactionDescription' => "MyBux Voucher Issue",
            'notificationUrl' => "https://buyingbro.com/mybux/callback"
        ];

        $response = Http::withBasicAuth('2348062177314', 'Bu1ngBr0')
        ->post("https://api.wallettec.com/integrate/rest/payment/v3/".env("WALLETTEC_SECRET")."/voucher/issue", $fields
        );

        dd($response->json());

        //dd($fields);
        $issueDetails = voucherIssue($fields);

        dd($issueDetails);


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'amount' => 'required|numeric',
            'code' => 'required|numeric'
        ]);

        $user = Auth::user();

        $fields = [
            'voucherNumber' => $request->code,
            'mobilenumber' => "+2348062177314", //$request->mobile ? $user->userprofile->mobile,
            'transactionAmount' => $request->amount,
            'transactionId' => Str::random(14),
            'notificationUrl' => "https://buyingbro.com/mybux/callback",
            'description' => "Deposit Order-".Str::random(6),

        ];

        //dd($request->all(), $fields);

        $response = voucherDeposit($fields);

        dd($response, $response->json());
    }


    public function mybuxCallback(Request $request)
    {
        $res = $request->all();
        Log::info($res);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Wallettec  $wallettec
     * @return \Illuminate\Http\Response
     */
    public function show(Wallettec $wallettec)
    {
        //
    }

    protected function addToOrdersTables($data)
    {
        $user = Auth::user();

        $order = Order::create([

            'user_id' => $user->id ? $user->id : null,
            'billing_name' => $user->name,
            'billing_email' => $user->email,
            'billing_phone' => $user->userprofile->mobile,
            'billing_address' => $user->userprofile->address,
            'billing_state' => $user->userprofile->state,
            'billing_country' => $user->userprofile->country,
            'billing_postalcode' => $user->userprofile->postcode,
            'billing_transaction_id' => $data['gatewaytransid'],
            'billing_subtotal' => str_replace(',', '', Cart::instance('default')->subtotal()),
            'payment_status' => 1,
            'payment_method' => "Wallettec",
            'billing_total' => str_replace(',', '', Cart::instance('default')->total()),
            'shipping_fee' => 0,
            'shipped' => 0,
            'billing_tax' => str_replace(',', '', Cart::instance('default')->tax()),

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
