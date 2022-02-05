<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\User;
use App\UserProfile;
use App\UserSupport;
use App\Discussion;

class UserSupportsController extends Controller
{
    //
    function index()
    {
        $user= Auth::user();

        $supports = UserSupport::whereUser_id($user->id)->with('discussions')->get();

        //dd($supports);
        //$supports = UserSupport::whereUser_id($user->id)->orderBy('created_at','desc');
        $sentCount = UserSupport::where('user_id', $user->id)->get();
        $inboxCount = Discussion::where([
									    ['user_id', '=', $user->id],
									    ['type', '=', 1]
										])->get();


        return view('users.support.index', compact ('supports', 'sentCount', 'inboxCount'));

    }

    public function create()
    {

        return view('users.support.create');

    }

    public function message(Request $request, $ticket)
    {
       //dd($request, $ticket);
       //
       $user = Auth::user();

       $this->validate($request, [
        'message' => 'required|min:10|max:4000',
        ]);

        $support = UserSupport::where('ticket', $ticket)->first();
        $support -> status = 1;
        $support->save();

        $discussion = Discussion::create([

            'user_support_id' => $support->id,
            'message' => $request->message,
            'user_id' => $user->id,
            'type'=> 0

        ]);


        return back()->with('success_message', 'Your Reply Message Has Been Successfully Submitted.');

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
        //dd($request);
        $user= Auth::user();
        $request = $this->validateRequest();

        $support = UserSupport::create([

            'ticket' => Str::random(13),
            'subject' => $request['subject'],
            'message' => $request['message'],
            'user_id' => $user->id,
            'status' => 1

        ]);

        return redirect ('user/send-ticket')->with('success_message', 'Your Support Ticket Has Been Successfully Created.');
    }

    public function show($id)
    {
        //dd($id);
        $user= Auth::user();
        $supports = UserSupport::with('user')->where('ticket', $id)->firstorfail();
        //dd($supports);
        $discussions = Discussion::where('user_support_id', $supports->id)->get();

        //dd($discussions);
        return view('users.support.show', compact('supports', 'discussions'));

    }

    private function validateRequest()
    {
        return request()->validate([
            'subject' => ['required', 'string', 'max:190'],
            'message' => 'required|min:10|max:190'

        ]);

    }
}
