<?php

namespace App\Http\Controllers;
use App\User;
use App\UserProfile;
use App\Order;
use App\UserWithdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersDashboard extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        //$user = Auth::user();
        $user_id = auth()->user()->id;
        $userprofile = UserProfile::where('user_id', '=', $user_id)->first();
        $orders = Order::where('user_id', $user_id)->get();
        $withdrawals = UserWithdraw::where([
                                            ['user_id', $user_id],
                                            ['status', 1]
                                            ])->get();
        //$user = UserProfile::where('user_id', $userprofile->id)->get();
        //dd($withdrawals);
        return view('users.index', compact('userprofile', 'orders', 'withdrawals'));
    }


    public function buycard()
    {
        //
        return view('users.giftcards.buy');
    }

    public function sellhistory()
    {
        //
        return view('users.giftcards.sellhistory');
    }

    public function buyhistory()
    {
        //
        return view('users.giftcards.buyhistory');
    }

     /**
     * Display a listing of the resource.
     *
     * CRYPTOCURRENCY
     */
    public function sellcrypto()
    {
        //
        return view('users.crypto.sell');
    }

    public function buycrypto()
    {
        //
        return view('users.crypto.buy');
    }

    public function sellcryptohistory()
    {
        //
        return view('users.crypto.cyptosellhistory');
    }

    public function buycryptohistory()
    {
        //
        return view('users.crypto.cryptobuyhistory');
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
