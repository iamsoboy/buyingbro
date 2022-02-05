<?php

namespace App\Http\Controllers;

use App\Http\AdyenClient;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AdyenController extends Controller
{
    protected $checkout;

    function __construct(AdyenClient $checkout) {
        $this->checkout = $checkout->service;
    }

    /**
     * Display a listing of all available payment gateway.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $user = Auth::user();
        //dd($request->all(), $user->userprofile);
        $amount = (str_replace(',', '', Cart::instance('default')->total()) * 100);
        $currency = currency()->getUserCurrency();
        $countryCode = json_decode(getCountryCode($request->country ? $user->userprofile->country : "US"), true);

        $params = array(
            "countryCode" => $countryCode['0']['alpha2Code'],
            "amount" => array(
                "currency" => $currency,
                "value" => $amount
            ),
            "merchantAccount" => env('ADYEN_MERCHANT_ACCOUNT')
        );

        $result = $this->checkout->paymentMethods($params);

        //dd($result, $result['paymentMethods']['0']['type'], $params, $countryCode['0']['alpha2Code'], $countryCode['0']['currencies']['0']['code']);

        $data = array(
            'type' => $result,
            'clientKey' => env('ADYEN_CLIENT_KEY'),
            'amount' => ($amount/100),
            'currency' => $currency
        );

        return view('checkout.adyen_checkout')->with($data);
    }


    // Result pages
    public function result(Request $request)
    {
        dd($request->all());
        $type = $request->type;
        return view('pages.result')->with('type', $type);
    }

    /* ################# API ENDPOINTS ###################### */
    // The API routes are exempted from app/Http/Middleware/VerifyCsrfToken.php

    public function getPaymentMethods(Request $request)
    {
        //error_log("Request for getPaymentMethods $request");
        $amount = (str_replace(',', '', Cart::instance('default')->total()) * 100);
        $currency = currency()->getUserCurrency();

        $params = array(
            "amount" => array(
                "currency" => $currency,
                "value" => $amount
            ),
            "merchantAccount" => env('ADYEN_MERCHANT_ACCOUNT'),
            //"channel" => "Web"
        );

        $response = $this->checkout->paymentMethods($params);

        return $response;
    }

    public function initiatePayment(Request $request)
    {
        error_log("Request for initiatePayment $request");

        $amount = (str_replace(',', '', Cart::instance('default')->total()) * 100);
        $currency = currency()->getUserCurrency();

        $orderRef = uniqid();
        $params = array(
            "merchantAccount" => env('ADYEN_MERCHANT_ACCOUNT'),
            "channel" => "Web", // required
            "amount" => array(
                "currency" => $currency, //$this->findCurrency(($request->paymentMethod)["type"]),
                "value" => $amount  // value is 10€ in minor units
            ),
            "reference" => $orderRef, // required
            // required for 3ds2 native flow
            "additionalData" => array(
                "allow3DS2" => "true"
            ),
            "origin" => "http://127.0.0.1:8000", // required for 3ds2 native flow
            "shopperIP" => $request->ip(),// required by some issuers for 3ds2
            // we pass the orderRef in return URL to get paymentData during redirects
            // required for 3ds2 redirect flow
            "returnUrl" => "http://127.0.0.1:8000/api/handleShopperRedirect?orderRef=${orderRef}",
            "paymentMethod" => $request->paymentMethod,
            "browserInfo" => $request->browserInfo // required for 3ds2
        );

        $response = $this->checkout->payments($params);

        return $response;
    }

    public function submitAdditionalDetails(Request $request)
    {
        //error_log("Request for submitAdditionalDetails $request");

        $payload = array("details" => $request->details, "paymentData" => $request->paymentData);

        $response = $this->checkout->paymentsDetails($payload);

        return $response;
    }

    public function handleShopperRedirect(Request $request)
    {
        error_log("Request for handleShopperRedirect $request");

        $redirect = $request->all();

        $details = array();
        if (isset($redirect["redirectResult"])) {
            $details["redirectResult"] = $redirect["redirectResult"];
        } else if (isset($redirect["payload"])) {
            $details["payload"] = $redirect["payload"];
        }
        $orderRef = $request->orderRef;

        $payload = array("details" => $details);

        $response = $this->checkout->paymentsDetails($payload);

        switch ($response["resultCode"]) {
            case "Authorised":
                return redirect()->route('result', ['type' => 'success']);
            case "Pending":
            case "Received":
                return redirect()->route('result', ['type' => 'pending']);
            case "Refused":
                return redirect()->route('result', ['type' => 'failed']);
            default:
                return redirect()->route('result', ['type' => 'error']);
        }
    }

    /* ################# end API ENDPOINTS ###################### */

    // Util functions
    public function findCurrency($type)
    {
        switch ($type) {
            case "ach":
                return "USD";
            case "wechatpayqr":
            case "alipay":
                return "CNY";
            case "dotpay":
                return "PLN";
            case "boletobancario":
            case "boletobancario_santander":
                return "BRL";
            default:
                return "EUR";
        }
    }


}
