<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\UserProfile;
use App\BankDetail;
use App\UserBank;

class UserProfilesController extends Controller
{
    public function index()
    {
        $user= Auth::user();

        $banks = BankDetail::where('active', true)->orderBy('name', 'asc')->get();

        return view('users.profile.index', compact('banks'));
    }

    public function create()
    {
        return view('users.profile.create');
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bank(Request $request)
    {

        $user= Auth::user();

        $this->validate($request, [
            'account_name' => ['required', 'string', 'max:120'],
            'account_number' => ['required', 'numeric', 'digits:10'],
            'bank_code' => ['required', 'string', 'max:190']
            ]);

        $bank = BankDetail::whereBankcode($request->bank_code)->first();

        $response = verifyBank($request->account_number, $request->bank_code);

        if($response){

            $result = json_decode($response, true);

            if($result['status'] == 'true')
            {
                $accountcheck = UserBank::whereUser_id($user->id)->first();

                if ($accountcheck) {

                    $user->userbank->account_name = $result['data']['account_name'];
                    $user->userbank->account_number = $result['data']['account_number'];
                    $user->userbank->bank_name = $bank->name;
                    $user->userbank->save();

                    return redirect()->route('profile.index')->with('success_message', 'Your Bank Details has been updated successfully.');

                } else {

                    UserBank::create([

                        'account_name' => $result['data']['account_name'],
                        'account_number' => $result['data']['account_number'],
                        'bank_name'=> $bank->name,
                        'user_id' => $user->id
                    ]);

                    return redirect()->route('profile.index')->with('success_message', 'Your Bank Details was added successfully.');

                }

            } else {

                $accountcheck = UserBank::whereUser_id($user->id)->first();

                if ($accountcheck) {

                    $user->userbank->account_name = $request->account_name;
                    $user->userbank->account_number = $request->account_number;
                    $user->userbank->bank_name = $bank->name;
                    $user->userbank->save();

                    return redirect()->route('profile.index')->withErrors('We could not resolve your account number. But if your sure, then go ahead.');

                } else {

                    UserBank::create([

                        'account_name' => $request->account_name,
                        'account_number' => $request->account_number,
                        'bank_name'=> $bank->name,
                        'user_id' => $user->id
                    ]);

                    return redirect()->route('profile.index')->withErrors('We could not resolve your account number. But if your sure, then go ahead.');

                }

            }

        } else {
            return redirect()->route('profile.index')->withErrors('Oops, Something went wrong. Try Again!');
        }

    }

    protected function passwordUpdate(Request $request)
    {
        $user= Auth::user();
        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'same:password', 'max:255'],
            ]);

        $user->password = Hash::make($request['password']);
        //dd($user->password);
        $user->save();

        return redirect()->route('profile.index')->with('success_message', 'Your Password was updated successfully.');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user= Auth::user();
        $request = $this->validateRequest();
       //dd($request);
        $user->name = $request['name'];
        $user->email = $request['email'];
        $user->username = $request['username'];
        $user->userprofile->mobile = $request['mobile'];
        $user->userprofile->address = $request['address'];
        $user->userprofile->state = $request['state'];
        $user->userprofile->postcode = $request['zip'];
        $user->userprofile->country = $request['country'];
        $user->userprofile->save();
        $user->save();

        if (request()->has('avatar')){
            $image = request()->file('avatar');
            $name = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/avatars');
            $image->move($destinationPath, $name);
            $user->userprofile->avatar =  $name;
            $user->userprofile->save();
        }
        //$this->storeImage($userprofile);

        return redirect ('user/profile')->with('success_message', 'Your Profile has been updated successfully.');

    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:190'],
            'email' => 'required|string|email|max:190|unique:users,email,'.auth()->id(), //['required', 'string', 'email', 'max:255', 'unique:users', 'email',.auth()->id()],
            'username' => 'required|string|max:190|unique:users,username,'.auth()->id(),//['required', 'string', 'max:255', 'unique:users'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            //'password_confirmation' => ['required', 'same:password', 'max:255'],
            'mobile' => ['required', 'string', 'max:190'],
            'address' => ['required', 'string', 'max:190'],
            'zip' => ['sometimes', 'string', 'max:20'],
            'country' => ['required', 'string', 'max:190'],
            'state' => ['required', 'string', 'max:190'],
            'avatar' => 'sometimes|file|image|max:1999|mimes:jpeg,bmp,png,jpg'
        ]);

    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => ['required', 'same:password', 'max:255'],
        ]);
    }

    private function storeImage($userprofile)
    {
/*
         if (request()->has('avatar')){
            $image = request()->file('avatar');
            $userprofile = time().'.'.$image->getClientOriginalExtension();
            $destinationPath = public_path('/storage/uploads/avatars');
            $image->move($destinationPath, $userprofile);
            //$user->userprofile->save();

            //dd($user);

            $userprofile->update([
                'avatar' => request()->avatar->store('uploads/avatars', 'public')

            ]);

            //dd($userprofile);
            //$avatar = $request->avatar;
            //$user->userprofile->avatar = $request['avatar'];
         }
         */
    }

}
