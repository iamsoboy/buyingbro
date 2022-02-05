<?php

namespace App\Http\Controllers;

use App\AvailableCards;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Sellcard;
use App\Brand;

class SellCardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $availableCards = AvailableCards::where('status', 1)->orderBy('name')->get();

        return view('users.giftcards.sell', compact('availableCards'));
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

        $this->validate($request, [
            'type' => 'required|string|max:190',
            'value' => 'required|numeric|max:10000',
            'description' => 'sometimes|string|max:190',
            'front' => 'required|file|image|max:1999|mimes:jpeg,bmp,png,jpg',
            'back' => 'required|file|image|max:1999|mimes:jpeg,bmp,png,jpg',
        ]);
        //$request = $this->validateRequest();
        //dd($this->validateRequest());

        $value = getDepositCurrency($request->value);

        if (request()->has('front')){
            $frontimage = request()->file('front');
            $frontname = 'storage/uploads/giftcards/'.Str::random(13).'.'.$frontimage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/giftcards');
            $frontimage->move($destinationPath, $frontname);
           // $user->userprofile->avatar =  '/storage/uploads/giftcards/'. $frontname;
            //$user->save();
        }

        if (request()->has('back')){
            $backimage = request()->file('back');
            $backname = 'storage/uploads/giftcards/'.Str::random(13).'.'.$backimage->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/giftcards');
            $backimage->move($destinationPath, $backname);
            //$user->userprofile->avatar =  '/storage/uploads/giftcards/'. $backname;
            //$user->save();
        }

        $sellcard = Sellcard::create([

            'reference' => Str::random(13),
            'name' => $request->type,
            'value' => $value,
            'description' => $request->description,
            'user_id' => $user->id,
            'status' => 0,
            'front' => $frontname,
            'back' => $backname

        ]);

        return redirect ('user/giftcard/sell')->with('success_message', 'Your Card has been submited successfully');
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

        $customers = Sellcard::where('user_id', $id)->orderBy('id', 'desc')->paginate(6);
        /*
        foreach ($customers as $customer) {
            $time = date('M j, Y  H:i:s', strtotime($customer->created_at));
        }

        dd($time);
        //$id = Auth::user()->id;
*/
        return view('users.giftcards.sellhistory', compact('customers'));
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

    private function validateRequest()
    {
        return request()->validate([
            'type' => ['required', 'string', 'max:190'],
            'value' => ['required', 'string', 'max:190'],
            'description' => ['sometimes', 'string', 'max:190'],
            'front' => 'required|file|image|max:1999|mimes:jpeg,bmp,png,jpg',
            'back' => 'required|file|image|max:1999|mimes:jpeg,bmp,png,jpg',
        ]);

    }
}
