<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use App\Gateway;
use App\UserDeposit;
use App\Notifications\depositSuccessful;
use App\Notifications\depositError;
use Unicodeveloper\Paystack\Facades\Paystack;

class UserDepositsController extends Controller
{

    public function index()
    {
        return view('users.wallet.deposithistory');
    }

    public function create()
    {
        $gateways = Gateway::orderBy('name', 'asc')->get();
        //dd($gateways->status);

        return view('users.wallet.deposit', compact('gateways'));

    }

     /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();

        if ($user->id != $id){

            return back();
        }

        $deposits = UserDeposit::where('user_id', $id)->orderBy('id', 'desc')->paginate(5);

        return view('users.wallet.deposithistory', compact ('deposits'));
    }

    public function verify(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'gateway' => 'required|numeric|max:200',
            'amount' => 'required|numeric',
        ]);

        $amount = getDepositCurrency($request->amount);

        if(setting('site.minimum_deposit') > $amount){
            //dd(setting('site.minimum_deposit'));
            return redirect ('user/deposit')->withErrors('Insufficient Funds. Amount below minimum deposit amount!');
        }

        $gateways = Gateway::whereId($request->gateway)->first();

        $percentage = $gateways->percent;
        $fixed = $gateways->fixed;
        $charge = (($percentage / 100) * $amount) + $fixed;
        $net_amount = $amount + $charge;

        $deposit = (object)array
        (
            'amount' => $amount,
            'charge' => $charge,
            'net_amount' => $net_amount,
            'code' => Str::random(13)
        );

        return view('users.wallet.verify', compact('user', 'gateways', 'deposit'));

    }

    public function instant(Request $request)
    {

        $user = Auth::user();

        $this->validate($request, [
            'amount' => 'required|numeric',
        ]);

        $real_amount = $request->amount;

        $amount = getDepositCurrency($request->amount);

        if(setting('site.minimum_deposit') > $amount){

            return redirect ('user/deposit')->withErrors('Insufficient Funds. Amount below minimum deposit amount!');
        }

        $gateways = Gateway::whereId(1)->first();

        $percentage = $gateways->percent;
        $fixed = $gateways->fixed;
        $charge = (($percentage / 100) * $amount) + $fixed;
        $net_amount = $amount + $charge;

        $deposit = (object)array
        (
            'amount' => $amount,
            'charge' => $charge,
            'net_amount' => $net_amount,
            'deposit_amount' => $real_amount
        );


        return view('users.wallet.instant', compact('user', 'gateways', 'deposit'));

    }

    /**
     * Redirect the User to Paystack Payment Page
     * @param Request $request
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {

        $user = Auth::user();

        $gateways = Gateway::whereId(1)->first();

        $deposit_amount = getDepositCurrency($request->amount);

        $percentage = $gateways->percent;
        $fixed = $gateways->fixed;
        $charge = ((($percentage / 100) * $deposit_amount) + $fixed);
        $net_amount = $deposit_amount + $charge;

        $amount = $net_amount * 100;

        $array = [ 'custom_fields' => [
            ['display_name' => "Payment Type", "variable_name" => "payment_type", "value" => "deposit"],
            ['display_name' => "Charge", "variable_name" => "charge", "value" => "$charge"],
            ['display_name' => "Amount", "variable_name" => "amount", "value" => "$deposit_amount"],
        ]

                ];

        //dd($amount, $net_amount, $charge, $fixed, $percentage, $deposit_amount);

        $request->request->add([
            'first_name' => $user->name,
            'email' => $user->email,
            'amount' => $amount,
            'quantity' => 1,
            'metadata' => $array,
        ]);

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
        $paymentDetails = Paystack::getPaymentData();


        //dd($paymentDetails);

        $user = Auth::user();

        if($result['data']['status'] == "success"){

            $deposit = UserDeposit::create([

                'transaction_id' => $request->refid,
                'gateway_name' => $request->gateway,
                'amount' => $request->amount,
                'details' => "No Deposit Details",
                'charge' => $request->charge,
                'user_id' => $user->id,
                'name' => $user->name,
                'status' => 1,
                'net_amount' => $request->net_amount,

            ]);

            $user->userprofile->deposit_balance = $user->userprofile->deposit_balance + $request->amount;
            $user->userprofile->save();

            Notification::send($user, new depositSuccessful($deposit));

            return redirect()->route('deposithistory.show', [$user])->with('success_message', 'Your Deposit request is successfully');

        } else{

            Notification::send($user, new depositError($deposit));

            return redirect ('user/deposit')->withErrors('Oops, something went wrong!');
        }
    }

    public function bank(Request $request)
    {

        $user = Auth::user();

        $deposit = UserDeposit::create([

            'transaction_id' => $request->reference,
            'gateway_name' => $request->gateway,
            'amount' => $request->amount,
            'details' => "No Deposit Details",
            'charge' => $request->charge,
            'user_id' => $user->id,
            'name' => $user->name,
            'status' => 0,
            'net_amount' => $request->net_amount,

        ]);

        return redirect()->route('deposithistory.show', [$user])->with('success_message', 'Your Deposit request was successfully. Kindly wait for transaction(s) to be confirmed');

    }

}
