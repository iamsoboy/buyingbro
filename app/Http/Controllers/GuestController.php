<?php

namespace App\Http\Controllers;
use App\Faq;
use App\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use App\Mail\ContactForm;
use App\Brand;
use App\Terms;

class GuestController extends Controller
{
    public function neosurf()
    {
        $request = new Request();
        $request->setMethod('POST');
        $request->request->add([
            'amount'   => 1000,
            'currency' => "eur",
            'language' => "en",
            'merchantId' => 24616,
            'merchantTransactionId' => 001,
            'prohibitedForMinors' => "no",
            'subMerchantId' => "http://127.0.0.1:8000",
            'test' => "yes",
            'urlOk' => "http://127.0.0.1:8000/ok",
            'urlKo' => "http://127.0.0.1:8000/not",
            'urlPending' => "http://127.0.0.1:8000/failed",
            'urlCallback' => "http://127.0.0.1:8000/neosurf/callback",
            'version' => 3,
        ]);

        $subItems = [];
        $subItems['amount'] = $request->amount;
        $subItems['currency'] = $request->currency;
        $subItems['language'] = $request->language;
        $subItems['merchantId'] = $request->merchantId;
        $subItems['merchantTransactionId'] = $request->merchantTransactionId;
        $subItems['prohibitedForMinors'] = $request->prohibitedForMinors;
        $subItems['subMerchantId'] = $request->subMerchantId;
        $subItems['test'] = $request->test;
        $subItems['urlOk'] = $request->urlOk;
        $subItems['urlKo'] = $request->urlKo;
        $subItems['urlPending'] = $request->urlPending;
        $subItems['urlCallback'] = $request->urlCallback;
        $subItems['version'] = $request->version;

        //dd($subItems);

        $paraSort = $subItems;
        ksort($paraSort);
        $string = '';
        foreach ($paraSort as $key => $value) {
            $string .= $value;
        }
        $hash =  hash('sha512', $string . 'dce637b66c6ed33ac6c7232cf1b85f56');
        //dd($hash, $string);
        return view('neosurf', compact('hash', 'subItems'));
    }

    public function sendneosurf(Request $request)
    {
        $paraSort = $request->all()->toArray();
        ksort($paraSort);
        $string = '';
        foreach ($paraSort as $key => $value) {
            $string .= $value;
        }
        $hash =  hash('sha512', $string . 'dce637b66c6ed33ac6c7232cf1b85f56');

        dd($request);
        return view('neosurf');
    }

    public function failedmsg(Request $request)
    {
        dd($request);
        return view('neosurf');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $faqs = Faq::take(4)->get();

        $testimonials = Testimonial::all();

        $brand = Brand::inRandomOrder()->take(9)->get();

        $imageUrl = 'http://localhost/purchase/blog/wp-json/wp/v2/posts?per_page=3';

        $result_from_posts = getUrl($imageUrl);

        $post = json_decode($result_from_posts, true);

        return view('frontend', compact('faqs', 'testimonials', 'post', 'brand'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyLogout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success_message', "Your Email Address Has Been Successfully Verified. Please login.");
    }

    public function terms()
    {
        $terms = Terms::where('title', 'Terms and Conditions')->first();

        return view('terms', compact('terms'));
    }

    public function privacy()
    {
        $privacy = Terms::where('title', 'privacy policy')->first();

        return view('privacy', compact('privacy'));
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        $testimonials = Testimonial::all();

        return view('about', compact('testimonials'));
    }

    public function howitworks()
    {
        return view('howitworks');
    }

    public function faq()
    {
        $faqs = Faq::all();

        return view('faq', compact('faqs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $data = request()->validate([
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
                'g-recaptcha-response' => 'required|captcha'
        ]);

        //Send Email
        Mail::to('info@purchasebro.com')->send(new ContactForm($data));

        return redirect()->route('contact.index')->with('success_message', 'Thanks for your message, We\'ll be in touch!');
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
