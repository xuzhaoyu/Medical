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

Route::get('/hospital/login', array(
    'as' => 'hospital-login',
    'uses' => 'AccountController@getHLogin'
));

Route::post('/hospital/login', array(
    'as' => 'hospital-login-post',
    'uses' => 'AccountController@postHLogin'
));

Route::get('/hospital/signup', array(
    'as' => 'hospital-signup',
    'uses' => 'AccountController@getHSignup'
));

Route::post('/hospital/signup', array(
    'as' => 'hospital-signup-post',
    'uses' => 'AccountController@postHSignup'
));

Route::get('/supplier/login', array(
    'as' => 'supplier-login',
    'uses' => 'AccountController@getSLogin'
));

Route::post('/supplier/login', array(
    'as' => 'supplier-login-post',
    'uses' => 'AccountController@postSLogin'
));

Route::get('/supplier/signup', array(
    'as' => 'supplier-signup',
    'uses' => 'AccountController@getSSignup'
));

Route::post('/supplier/signup', array(
    'as' => 'supplier-signup-post',
    'uses' => 'AccountController@postSSignup'
));
