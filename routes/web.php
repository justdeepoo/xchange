<?php

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
Route::group(['middleware' => ['web']], function () {
    // your routes here

//print_r($_POST);exit;	
	
Route::get('/', 'IndexController@index');
Route::get('/about', 'IndexController@about');
Route::get('trade/{coin}', 'TradeController@index');
Route::get('wallet', 'WalletController@index');
Route::get('ticker', 'XchangeController@ticker');

Route::get('secure/login', 'SecureController@login');
Route::get('secure/register', 'SecureController@register');
Route::get('secure/forgot-password', 'SecureController@forgot');
Route::get('profile', 'ProfileController@index');
Route::get('secure/logout', 'SecureController@logout');
Route::get('balance', 'BalanceController@index');
Route::get('secure/confirm-email', 'SecureController@confirm_email');
Route::get('/faq', 'IndexController@faq');
Route::get('/support', 'IndexController@support');
Route::get('/contact', 'IndexController@contact');

Route::post('/contact', 'IndexController@contactPost');
//Route::post('/contact', 'IndexController@subscriberPost');

Route::get('/aml', 'IndexController@aml');
Route::get('/fee', 'IndexController@fee');
Route::get('/terms-condition', 'IndexController@terms');
Route::get('/privacy', 'IndexController@privacy');
Route::get('/disclaimer', 'IndexController@disclaimer');
Route::post('current-bal', 'XchangeController@getCurrentBal');
Route::get('secure/set-password/token/{any}', 'SecureController@reset_password');
Route::post('secure/set_password', 'SecureController@set_password');
Route::get('/test-email', 'SecureController@sendTestEmail');
Route::get('/calculator', 'IndexController@calculator');





Route::post('buy', 'XchangeController@buy');
Route::post('sell', 'XchangeController@sell');
Route::post('open-orders', 'XchangeController@get_open_orders');
Route::post('cancel-trade', 'XchangeController@cancel_trade');
Route::post('trade', 'XchangeController@getTrades');
Route::post('buy-sell', 'XchangeController@buySaleOrder');
Route::post('buy-sell-trade', 'XchangeController@buySaleOrder');
Route::post('my-trades', 'XchangeController@mytrades');
Route::post('txn-history', 'XchangeController@transactoin_history');


Route::post('post-register', 'SecureController@post_register');
Route::post('post-login', 'SecureController@post_login');
Route::post('withdraw', 'WalletController@post_withdraw');
Route::post('submit-profile', 'ProfileController@submit_profile');
Route::post('submit-bank', 'ProfileController@submit_bank');
Route::post('submit-kyc', 'ProfileController@submit_kyc');
Route::post('submit-deposit-request', 'BalanceController@submit_deposit_request');
Route::post('submit-withdraw-request', 'BalanceController@submit_withdraw_request');

Route::post('set2FA', 'ProfileController@set2FA');
Route::post('reset-password', 'ProfileController@reset_password');
Route::post('post_forgot', 'SecureController@post_forgot');
Route::post('submit-address', 'ProfileController@submit_address');
Route::post('submit-bank', 'ProfileController@submit_bank');
Route::get('/addtoken', 'IndexController@addtoken');
Route::post('/addtoken', 'IndexController@addtokencryptoPost');
Route::get('/news', 'IndexController@news');
});

Route::get('history', 'BalanceController@tradeHistory');
Route::get('header-notification', 'BalanceController@headerNotification');

Route::post('submit-del-deposit-req', 'BalanceController@submitDelDepositReq');
Route::post('submit-del-withdraw-req', 'BalanceController@submitDelWithdrawReq');

Route::get('/customersupport', 'IndexController@customersupport');
Route::post('/customersupport', 'IndexController@customersuppPost');





