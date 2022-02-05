<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Kyc;

class UsersKyc extends Controller
{

    public function create()
    {
        $user = Auth::user();
        $customers = Kyc::where('user_id', $user->id)->get();
        //dd($customers);

        return view('users.kyc.create', compact('customers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $request = $this->validateRequest();
        //dd($this->validateRequest());

        if (request()->has('front')){
            $frontimage = request()->file('front');
            $frontname = 'storage/uploads/verifications/'.Str::random(13).'.'.$frontimage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/verifications');
            $frontimage->move($destinationPath, $frontname);
           // $user->userprofile->avatar =  '/storage/uploads/giftcards/'. $frontname;
            //$user->save();
        }

        if (request()->has('back')){
            $backimage = request()->file('back');
            $backname = 'storage/uploads/verifications/'.Str::random(13).'.'.$backimage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/verifications');
            $backimage->move($destinationPath, $backname);
            //$user->userprofile->avatar =  '/storage/uploads/giftcards/'. $backname;
            //$user->save();
        }

        $kyc = Kyc::create([

            'name' => $request['name'],
            'number' => $request['number'],
            'expiry_date' => $request['expiry_date'],
            'user_id' => $user->id,
            'status' => 0,
            'front' => $frontname,
            'back' => $backname

        ]);

        return redirect ('user/kyc');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $request = $this->validateRequest();

        $userkyc = Kyc::where('user_id', $user->id)->findOrFail(1);

        if (request()->has('front')){
            $frontimage = request()->file('front');
            $frontname = 'storage/uploads/verifications/'.Str::random(13).'.'.$frontimage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/verifications');
            $frontimage->move($destinationPath, $frontname);
        }

        if (request()->has('back')){
            $backimage = request()->file('back');
            $backname = 'storage/uploads/verifications/'.Str::random(13).'.'.$backimage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/verifications');
            $backimage->move($destinationPath, $backname);
        }

        $userkyc->name = $request['name'];
        $userkyc->number = $request['number'];
        $userkyc->expiry_date = $request['expiry_date'];
        $userkyc->front = $frontname;
        $userkyc->back = $backname;
        $userkyc->status = 0;
        $userkyc->save();

        return redirect ('user/kyc');

    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:190'],
            'number' => ['required', 'string', 'max:190'],
            'expiry_date' => ['required', 'string', 'max:190'],
            'front' => 'required|file|image|max:1999|mimes:jpeg,bmp,png,jpg',
            'back' => 'required|file|image|max:1999|mimes:jpeg,bmp,png,jpg',
        ]);

    }
}
