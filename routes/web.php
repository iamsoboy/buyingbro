<?php

use Illuminate\Support\Facades\Route;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('preview-emails', function () {
    $message = (new \App\Notifications\userEmailVerificationNotification(\App\User::first()));
    return $message;
});

Route::get('mail', function () {
    return (new App\Notifications\userEmailVerificationNotification());
});

Route::get('wallet', "GuestController@wallet")->name('wallet');

Route::get('neosurf', "GuestController@neosurf")->name('neosurf');
Route::post('neosurf', "GuestController@sendneosurf")->name('sendneosurf');
Route::get('neosurf/callback', "GuestController@failedmsg")->name('failedmsg');

Route::get('/', "GuestController@index")->name('index');
Route::get('news', 'GuestController@news')->name('news.create');
Route::get('about', 'GuestController@about')->name('about.create');
Route::get('contact-us', 'GuestController@contact')->name('contact.index');
Route::post('/contact-us', 'GuestController@store')->name('contact.store');
Route::get('/verify/logout', 'GuestController@verifyLogout')->name('verifyLogout');
Route::get('how-it-works', 'GuestController@howitworks')->name('howitworks');

/*
Legal Routes
*/
Route::get('terms-and-conditions', 'GuestController@terms')->name('terms');
Route::get('privacy-policy', 'GuestController@privacy')->name('privacy');
Route::get('faq', 'GuestController@faq')->name('faq');

/*
Shop Routes
*/
Route::get('shop', 'ShopController@index')->name('shop.index');
Route::get('shop/{brand}', 'ShopController@show')->name('shop.show');

//MyBux Purchase
Route::get('shop/voucher/{brand}', 'ShopController@myBuxShow')->name('shop.myBux');
Route::get('mybux/paymentInstructions', 'WallettecController@buyMyBuxPaymentInstructions')->name('buyMyBuxPaymentInstructions');
Route::get('mybux/paymentStatus', 'WallettecController@getStatus')->name('getStatus');
Route::post('mybux/callback', 'WallettecController@mybuxCallback')->name('mybuxCallback');

Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cart/{product}', 'CartController@destroy')->name('cart.destroy');
Route::post('/cart/wishlist/{product}', 'CartController@wishlist')->name('cart.wishlist');

Route::delete('/saveForLater/{product}', 'WishlistController@destroy')->name('wishlist.destroy');
Route::post('/saveForLater/wishlist/{product}', 'WishlistController@wishlistToCart')->name('wishlistTo.cart');

Route::get('currency', ['uses'=>'CurrencyController@set']);



//Route::post('/cart', 'CouponsController@store')->name('coupon.store');
//Route::delete('/cart', 'CouponsController@destroy')->name('coupon.destroy');

Route::get('empty', function(){
    Cart::instance('default')->destroy();
});


Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');


Route::group([
                'prefix' => 'admin',
                'excluded_middleware' => ['currency'],
            ], function () {
    Voyager::routes();
});


/*
|--------------------------------------------------------------------------
| Web Routes for user
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth', 'verified'])->group(function () {

Route::get('/checkout', 'CheckoutController@index')->name('checkout.index');
Route::post('/checkout/pay', 'CheckoutController@store')->name('checkout.store');
Route::post('/checkout/payviawallet', 'CheckoutController@wallet')->name('checkout.wallet');
Route::get('/checkout/paid/{id}', 'CheckoutController@show')->name('checkout.show');

// PayStack Route
Route::post('/pay', 'PaymentController@redirectToGateway')->name('pay');
Route::get('/payment/callback', 'PaymentController@handleGatewayCallback');

//MyBux Route
Route::post('shop/mybux/payment', 'WallettecController@buyMyBux')->name('buyMyBux');

//Checkout.com Route
Route::get('/checkout_test', 'PaymentController@toCheckoutGatewayForm');
Route::post('/checkout_test', 'PaymentController@redirectToCheckoutGateway')->name('payWithCheckout');

// Route for stripe payment form.
Route::get('stripe', 'StripeController@payWithStripe')->name('stripform');
// Route for stripe post request.
Route::post('stripe', 'StripeController@postPaymentWithStripe')->name('paywithstripe');

Route::get('/checkout/{type}', 'AdyenController@checkout');
Route::post('/api/checkout-payments', 'AdyenController@index')->name('payWithAdyen');
Route::get('/result/{type}', 'AdyenController@result')->name('result');
// The API routes are exempted from app/Http/Middleware/VerifyCsrfToken.php
Route::post('/api/getPaymentMethods', 'AdyenController@getPaymentMethods');
Route::post('/api/initiatePayment', 'AdyenController@initiatePayment');
Route::post('/api/submitAdditionalDetails', 'AdyenController@submitAdditionalDetails');
Route::match(['get', 'post'], '/api/handleShopperRedirect', 'AdyenController@handleShopperRedirect');

Route::get('user/dashboard', 'HomeController@index')->name('index');

Route::get('user/giftcard/sell', 'SellCardController@create')->name('sell.create');
Route::post('user/giftcard/sell', 'SellCardController@store')->name('sell.store');
Route::get('user/giftcard/buy', 'UsersDashboard@buycard')->name('buy.create');
Route::get('user/giftcard/sell-history/{id}', 'SellCardController@show')->name('sellhistory.show');
Route::get('user/giftcard/buy-history/{id}', 'BuyCardController@show')->name('buyhistory.show');

Route::get('user/crypto/sell', 'UsersDashboard@sellcrypto')->name('sellcrypto.create');
Route::get('user/crypto/buy', 'UsersDashboard@buycrypto')->name('buycrypto.create');
Route::get('user/crypto/sell-history', 'UsersDashboard@sellcryptohistory')->name('cryptosellhistory.create');
Route::get('user/crypto/buy-history', 'UsersDashboard@buycryptohistory')->name('cryptobuyshistory.create');

Route::get('user/orders/{id}', 'OrderController@show')->name('orders.show');


Route::get('user/deposit-history/{id}', 'UserDepositsController@show')->name('deposithistory.show');
Route::get('user/deposit', 'UserDepositsController@create')->name('deposit.create');
Route::post('user/deposit/preview', 'UserDepositsController@verify')->name('deposit.verify');
Route::post('user/deposit/preview/instant', 'UserDepositsController@instant')->name('deposit.instant');
Route::post('user/deposit/pay', 'UserDepositsController@redirectToGateway')->name('deposit.insert');
Route::get('user/deposit/payment/callback', 'UserDepositsController@handleGatewayCallback');
Route::post('user/deposit/bank', 'UserDepositsController@bank')->name('deposit.bank');

Route::post('user/deposit/voucher', 'WallettecController@store')->name('deposit.voucher');
Route::post('user/voucher/issue', 'WallettecController@issueVoucher')->name('voucherIssue');

Route::get('user/withdraw-history/{id}', 'UserWithdrawsController@show')->name('withdraw.show');
Route::get('user/withdraw', 'UserWithdrawsController@create')->name('withdraw.create');
Route::post('user/withdraw', 'UserWithdrawsController@store')->name('withdraw.store');

Route::get('user/profile', 'UserProfilesController@index')->name('profile.index');
Route::patch('user/profile', 'UserProfilesController@bank')->name('profile.bank');
Route::post('user/profile', 'UserProfilesController@passwordUpdate')->name('profile.password');
//Route::get('user/edit-profile', 'UserProfilesController@create')->name('profile.create');
Route::patch('user/edit-profile', 'UserProfilesController@update')->name('profile.update');

Route::get('user/kyc', 'UsersKyc@create')->name('kyc.create');
Route::post('user/kyc', 'UsersKyc@store')->name('kyc.store');
Route::patch('user/kyc', 'UsersKyc@update')->name('kyc.update');

Route::get('user/support', 'UserSupportsController@index')->name('support.index');
Route::get('user/send-ticket', 'UserSupportsController@create')->name('support.create');
Route::post('user/send-ticket', 'UserSupportsController@store')->name('support.store');
Route::post('user/support/ticket/{ticket}', 'UserSupportsController@message')->name('support.update');
Route::get('user/show-ticket/{ticket}', 'UserSupportsController@show')->name('support.show');

Route::get('user/review', 'UserReviewsController@create')->name('review.create');
Route::post('user/review', 'UserReviewsController@store')->name('review.store');





});

Route::get('mail', function () {
    $invoice = App\User::find(1);

    return (new App\Notifications\orderFailed($invoice))
                ->toMail($invoice->email);
});
/*
Route::fallback(function () {

    return view("404");

});
*/
