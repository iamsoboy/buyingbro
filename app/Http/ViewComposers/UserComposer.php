<?php

namespace App\Http\ViewComposers;

use App\Repositories\UserRepository;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\UserProfile;

class UserComposer
{
    

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        
        $user = Auth::user();
        $user_id = auth()->user()->id;
        
        $userprofile = UserProfile::with('user')->where('user_id', '=', $user_id)->first();

        //dd($userprofile->avatar);
        $view->with('user', $user)->with('userprofile', $userprofile); 
    }
}