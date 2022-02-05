<?php

namespace App\Http\Controllers;

use App\UserSupport;
use Illuminate\Http\Request;
use App\User;
use App\UserProfile;
use App\Order;
use App\UserWithdraw;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $userprofile = UserProfile::where('user_id', '=', $user_id)->first();
        $orders = Order::where('user_id', $user_id)->get();
        $withdrawals = UserWithdraw::where([
                                            ['user_id', $user_id],
                                            ['status', 1]
                                            ])->get();

        $getorders = Order::where('user_id', $user_id)->orderBy('id', 'desc')->with('products')->take(5)->get();
        $supports = UserSupport::whereUser_id($user_id)->with('discussions')->take(5)->get();
        //$user = UserProfile::where('user_id', $userprofile->id)->get();
        //dd($supports);
        return view('users.index', compact('userprofile', 'orders', 'withdrawals', 'getorders', 'supports'));
    }
}
