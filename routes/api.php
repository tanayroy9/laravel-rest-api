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

Route::post('registration','Api\CustomController@registration');
Route::post('login','Api\CustomController@login');
Route::post('password/email','Api\CustomController@forgotPassword');
Route::post('logout','Api\CustomController@logoutApi');
Route::post('password/reset', 'Api\PasswordResetController@passwordReset');
Route::get('password/email-find/{token}', 'Api\PasswordResetController@emailFind');
Route::post('password/reset-confirm', 'Api\PasswordResetController@resetConfirm');
Route::group(['middleware' => 'auth:api'], function(){
    Route::get('hello', 'Api\CustomController@hello');
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
