<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\UserWithdraw;
use App\Gateway;
use App\UserBank;
use App\BankDetail;
use App\Notifications\withdrawalSuccessful;
use App\Notifications\withdrawalError;
use Unicodeveloper\Paystack\Facades\Paystack;

//use Illuminate\Support\Facades\Gate;

class UserWithdrawsController extends Controller
{

    function index()
    {

        return view('users.withdraw.index');

    }

    function create()
    {
        $gateways = Gateway::whereStatus(1)->orderBy('name', 'asc')->get();

        return view('users.withdraw.create', compact('gateways'));

    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $this->validate($request, [
            'gateway' => 'required|string|max:190',
            'amount' => 'required|numeric',
            'details' => 'required|string|max:500',
        ]);

        $amount = getDepositCurrency($request->amount);

        if(setting('site.minimum_withdraw') > $amount){
            //dd(setting('site.minimum_withdraw'));
            return redirect ('user/withdraw')->withErrors('Insufficient Funds. Amount below minimum withdrawal amount!');
        }

        if($user->userprofile->main_balance <= $amount) {
           //dd($user->userprofile->main_balance);
            return redirect ('user/withdraw')->withErrors('Insufficient Funds! Amount above withdrawable balance!');
        }

        $method = Gateway::whereId($request->gateway)->first();

        $percentage = $method->percent;
        $fixed = $method->fixed;
        $charge = (($percentage / 100) * $amount) + $fixed;
        $new_amount = ($amount - $charge);

        if ($method->id == 1){

            $user_data = UserBank::whereUser_id($user->id)->first();

            if($user_data)
            {
                $bank_data = BankDetail::whereName($user_data->bank_name)->first();

                $fields = [
                    'type' => $bank_data->type,
                    'name' => $user_data->account_name,
                    'account_number' => $user_data->account_number,
                    'bank_code' => $bank_data->bankcode,
                    'currency' => $bank_data->currency
                  ];

                $transfer_details = transfer($fields);

                $transferRecipient = json_decode($transfer_details, true);

                if($transferRecipient['status'] == "true"){

                    $user->userbank->recipient_code = $transferRecipient['data']['recipient_code'];
                    $user->userbank->save();

                    $fundfields = [
                        'source' => "balance",
                        'amount' => $new_amount * 100,
                        'recipient' => $transferRecipient['data']['recipient_code'],
                        'reason' => "PurchaseBro Withdrawal Payment"
                      ];

                    $transferAction = fundTransfer($fundfields);

                    $fundTransfer = json_decode($transferAction, true);

                    if($transferRecipient['status'] == "true" || $fundTransfer == "true"){

                        //dd($fundTransfer, $transferRecipient, $fundfields, $transferRecipient['data']['transfer_code']);

                        $withdraw = UserWithdraw::create([

                            'reference' => Paystack::genTranxRef(),
                            'method' => $method->name,
                            'amount' => $amount,
                            'details' => $request->details,
                            'charge' => $charge,
                            'user_id' => $user->id,
                            'name' => $user->name,
                            'status' => 0,
                            'net_amount' => $new_amount,
                            'transfer_code' => $fundTransfer['data']['transfer_code']

                        ]);

                        Notification::send($user, new withdrawalSuccessful($withdraw));

                        return redirect ('user/withdraw')->with('success_message', 'Your Withdrawal request is successfully');

                        $user->userbank->recipient_code = $transferRecipient['data']['recipient_code'];
                        $user->userbank->save();

                    } else {

                        return redirect()->route('withdraw.create')->withErrors('Oops! Something went wrong. Transfer failed.');

                    }

                } else {
                    return redirect()->route('withdraw.create')->withErrors('Transfer recipient/receiver failed. Try again');
                }

            } else {
                return redirect()->route('withdraw.create')->withErrors('No Bank Account Detected! Add your bank details!');
            }



        }

        $withdraw = UserWithdraw::create([

            'reference' => Paystack::genTranxRef(),
            'method' => $method->name,
            'amount' => $amount,
            'details' => $request->details,
            'charge' => $charge,
            'user_id' => $user->id,
            'name' => $user->name,
            'status' => 0,
            'net_amount' => $new_amount,

        ]);

        return redirect ('user/withdraw')->with('success_message', 'Your Withdrawal request is successfully');

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

        $withdraws = UserWithdraw::where('user_id', $id)->orderBy('id', 'desc')->paginate(5);

        return view('users.withdraw.index', compact('withdraws'));
    }

    /*
    private function validateRequest()
    {
        return request()->validate([
            'method' => ['required', 'string', 'max:190'],
            'amount' => ['required', 'integer'],
            'details' => ['required', 'string', 'max:190'],
        ]);

    }
    */
}
