<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('{coin}/wallet/{wallet}', 'BitgoController@get_wallet_info');

Route::post('wallet/generate', 'BitgoController@generate_wallet');

Route::post('user/register', 'Auth\RegisterController@register');

Route::post('user/login', 'Auth\LoginController@login');

Route::post('user/wallet/info', 'UserController@wallet_address');

Route::post('verify/2fa', 'Auth\RegisterController@verify2fa');

Route::post('wallet/prebuild/tx', 'BitgoController@post_txn_build');

Route::post('wallet/send/tx', 'UserController@wallet_send_txn');

Route::post('wallet/set/address', 'BitgoController@post_set_xrp_address');

Route::post('user/wallet/balance', 'UserController@wallet_balance');

Route::post('user/wallet/callback', 'UserController@wallet_call_back');

Route::get('user/transaction/{token}', 'UserController@wallet_txn_detail');

Route::get('user/testEmail', 'UserController@testEmail');
