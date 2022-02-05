<?php

use App\Gateway;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

function profileImage($path)
{
    return $path && file_exists ('storage/uploads/avatars/'.$path) ? asset('/storage/uploads/avatars/'.$path) : asset('/storage/uploads/avatars/default-avatar.png');
}

function getUrl($imageUrl)
{

    $ch = curl_init($imageUrl);

    //set request parameters
    curl_setopt($ch, CURLOPT_URL, $imageUrl);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

    //send request
    $url = curl_exec($ch);
    //close connection
    curl_close($ch);

    return $url;
}

function getBrandsTotal($price)
{
    $totalSum = sum('$price');
    return number_format($totalSum, 2, '.', ',');
}

function getSourceImage($array)
{
    $blogImages = $array['source_url'];
    return $blogImages;
}

function unset_number($amount)
{
    $number = str_replace(array(',', ''), '', $amount);
    return $number;
}


function getDepositCurrency($amount)
{
    $userCurrency = currency()->getUserCurrency();

    if ($userCurrency == 'USD')
    {
        $nairaAmount = round($amount / 0.00258737);
        return $nairaAmount;
    }
    else if ($userCurrency == 'EUR')
    {
        $nairaAmount = round($amount / 0.00216731);
        return $nairaAmount;
    }
    else if ($userCurrency == 'GBP')
    {
        $nairaAmount = round($amount / 0.00193556);
        return $nairaAmount;
    }
    else {
        return $amount;
    }

}

/**
function getWithdrawCurrency($amount)
{
    $userCurrency = currency()->getUserCurrency();

    if ($userCurrency == 'USD')
    {
        $nairaAmount = round($amount * 0.00258737);
        return $nairaAmount;
    }
    else if ($userCurrency == 'EUR')
    {
        $nairaAmount = round($amount * 0.00216731);
        return $nairaAmount;
    }
    else if ($userCurrency == 'GBP')
    {
        $nairaAmount = round($amount * 0.00193556);
        return $nairaAmount;
    }
    else {
        return $amount;
    }

}
 *
 * */

function processUserDeposit()
{

}

function verifyBank($account_number, $bank_code)
{
    //The parameter after verify/ is the transaction reference to be verified
    $url = 'https://api.paystack.co/bank/resolve?account_number='.$account_number.'&bank_code='.$bank_code;
    //open connection
    $ch = curl_init();

    //set request parameters
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer sk_test_840bf2c1df152e42a52f8d36b3b729a869582edb", "Cache-Control: no-cache"]);

    //send request
    $response = curl_exec($ch);
    curl_close($ch);

    //Check for errors
    $err = curl_error($ch);

    //close connection
    curl_close($ch);

    if ($err) {
        return $err;
        } else {
        return $response;
        }
}


function transfer($fields)
{
    $url = "https://api.paystack.co/transferrecipient";

    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();

    //set request parameters
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer sk_test_840bf2c1df152e42a52f8d36b3b729a869582edb", "Cache-Control: no-cache"]);

    //execute post
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function fundTransfer($fields)
{
    $url = "https://api.paystack.co/transfer";

    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();

    //set request parameters
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer sk_test_840bf2c1df152e42a52f8d36b3b729a869582edb", "Cache-Control: no-cache"]);

    //execute post
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function finalizeTransfer($fields)
{
    $url = "https://api.paystack.co/transfer/finalize_transfer";

    $fields_string = http_build_query($fields);

    //open connection
    $ch = curl_init();

    //set request parameters
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer sk_test_840bf2c1df152e42a52f8d36b3b729a869582edb", "Cache-Control: no-cache"]);

    //execute post
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function supported_currency()
{
    $currency = DB::table('currencies')->pluck('code');

    return $currency;
}

function getCardToken()
{

    $cardTokenConfig['authorization'] = "pk_test_88a9f52e-17e3-4a3f-a11e-669757454288" ;

    $Api = \CheckoutApi_Api::getApi();
    $cardTokenConfig['postedParam'] = array (


        'number' => '4543474002249996',
        'expiryMonth' => 06,
        'expiryYear' => 2017,
        'cvv' => 956,

    );
    $respondCardToken = $Api->getCardToken( $cardTokenConfig );

    if($respondCardToken->isValid()) {
        return  $respondCardToken->getId();
    }

    return null;

}

function getCountryCode($data)
{
    $url = "https://restcountries.eu/rest/v2/name/$data";

    //open connection
    $ch = curl_init();

    //set request parameters
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_ENCODING, "");
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    //curl_setopt($ch, CURLOPT_POST, 1);
    //curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
    //curl_setopt($ch, CURLOPT_HTTPHEADER, ["Authorization: Bearer sk_test_840bf2c1df152e42a52f8d36b3b729a869582edb", "Cache-Control: no-cache"]);

    //execute post
    $result = curl_exec($ch);
    curl_close($ch);

    return $result;
}

function voucherIssue($fields)
{
    return $response = Http::withBasicAuth('2348062177314', 'Bu1ngBr0')
        ->post("https://api.wallettec.com/integrate/rest/payment/v3/".env("WALLETTEC_SECRET")."/voucher/issue", $fields );
}

function voucherDeposit($fields)
{

    return $response = Http::withBasicAuth('2348062177314', 'Bu1ngBr0')
                ->post('https://api.wallettec.com/integrate/rest/payment/v3/'.env("WALLETTEC_SECRET").'/voucher/deposit', $fields );

}

function requestPayment($fields)
{
    return $response = Http::withBasicAuth('2348062177314', 'Bu1ngBr0')
        ->post('https://api.wallettec.com/integrate/rest/payment/v3/'.env("WALLETTEC_SECRET").'/request', $fields);
}

function getPaymentStatus($id)
{
    return $response = Http::withBasicAuth('2348062177314', 'Bu1ngBr0')
        ->get('https://api.wallettec.com/integrate/rest/general/'.env("WALLETTEC_SECRET").'/query/'.$id);
}
