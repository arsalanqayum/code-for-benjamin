<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['middleware' => 'guest:api'], function () {
    Route::get('team', 'TeamController@index');
    Route::get('careers', 'CareersController@index');
    Route::get('store', 'StoreController@index');
    Route::get('contact', 'ContactController@index');

    Route::post('login', 'Auth\LoginController@login');
    Route::post('register', 'Auth\RegisterController@register');

    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

    Route::post('email/verify/{user}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::post('email/resend', 'Auth\VerificationController@resend');

    Route::post('oauth/{driver}', 'Auth\OAuthController@redirectToProvider');
    Route::get('oauth/{driver}/callback', 'Auth\OAuthController@handleProviderCallback')->name('oauth.callback');
});


Route::group(['middleware'=>'auth:api'],function(){

    Route::post('logout', 'Auth\LoginController@logout');
    Route::get('/user', 'Auth\UserController@current');
    Route::patch('settings/profile', 'Settings\ProfileController@update');
    Route::patch('settings/password', 'Settings\PasswordController@update');

        Route::group(['prefix'=>'admin'],function (){
            Route::get('users', 'API\v1\Admin\AdminUsersController@index');
            Route::get('user/{id}', 'API\v1\Admin\AdminUsersController@edit');
            Route::post('update-user/{id}', 'API\v1\Admin\AdminUsersController@update');
            Route::delete('users/{id}', 'API\v1\Admin\AdminUsersController@destroy');
        });

});
