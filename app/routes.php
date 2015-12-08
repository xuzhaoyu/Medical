<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return View::make('welcome');
});

Route::get('/account/login', array(
    'as' => 'account-login',
    'uses' => 'AccountController@getLogin'
));

Route::post('/account/login', array(
    'as' => 'account-login-post',
    'uses' => 'AccountController@postLogin'
));

Route::get('/hospital/signup', array(
    'as' => 'hospital-signup',
    'uses' => 'AccountController@getHSignup'
));

Route::post('/hospital/signup', array(
    'as' => 'hospital-signup-post',
    'uses' => 'AccountController@postHSignup'
));

Route::get('/supplier/signup', array(
    'as' => 'supplier-signup',
    'uses' => 'AccountController@getSSignup'
));

Route::post('/supplier/signup', array(
    'as' => 'supplier-signup-post',
    'uses' => 'AccountController@postSSignup'
));

Route::get('/supplier/incomplete', array(
    'as' => 'incomplete',
    'uses' => 'SupplierController@getIncomplete'
));

Route::get('/supplier/complete', array(
    'as' => 'complete',
    'uses' => 'SupplierController@getComplete'
));