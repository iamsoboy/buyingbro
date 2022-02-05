<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\UserProfile;
use App\Testimonial;

class UserReviewsController extends Controller
{
    //
    function create()
    {

        return view('users.review.create');

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

        $user= Auth::user();
        $request = $this->validateRequest();

        $userprofile = UserProfile::where('user_id', $user->id)->first();

        //dd($userprofile);
        $testimonial = Testimonial::create([

            'name' => $request['name'],
            'title' => $request['title'],
            'comment' => $request['comment'],
            'image' => '/uploads/avatars/'.$userprofile->avatar,
            'status' => 0

        ]);

        return redirect('user/review')->with('success_message', 'Much Thanks... Your Review was submitted successfully');
    }

    private function validateRequest()
    {
        return request()->validate([
            'name' => ['required', 'string', 'max:190'],
            'title' => ['required', 'string', 'max:190'],
            'comment' => 'required|min:10|max:190'

        ]);

    }
}
