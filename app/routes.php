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

Route::get('/', array(
    'as' => 'account-login',
    'uses' => 'AccountController@welcome'
));

Route::post('/account/login', array(
    'as' => 'account-login-post',
    'uses' => 'AccountController@postLogin'
));

Route::get('/account/logoff', array(
    'as' => 'account-logoff',
    'uses' => 'AccountController@getLogoff'
));

Route::get('/hospital/signup', array(
    'as' => 'hospital-signup',
    'uses' => 'AccountController@getHSignup'
));

Route::post('/hospital/signup', array(
    'as' => 'hospital-signup-post',
    'uses' => 'AccountController@postHSignup'
));

Route::get('/hospital/list', array(
    'as' => 'hospital-list',
    'uses' => 'OrderController@getList'
));

Route::post('/hospital/list/search', array(
    'as' => 'hospital-list-search',
    'uses' => 'OrderController@postSearch'
));

Route::post('/hospital/list', array(
    'as' => 'hospital-list-post',
    'uses' => 'OrderController@postNewItem'
));

Route::get('/hospital/cart', array(
    'as' => 'hospital-cart',
    'uses' => 'OrderController@getCart'
));

Route::get('/hospital/complete', array(
    'as' => 'hospital-complete',
    'uses' => 'OrderController@getComplete'
));

Route::post('/hospital/cart', array(
    'as' => 'hospital-cart-post',
    'uses' => 'OrderController@postCart'
));

Route::get('/hospital/cart/delete/{order_id}', array(
    'as' => 'hospital-cart-delete',
    'uses' => 'OrderController@getCartDelete'
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

Route::get('/supplier/incomplete/send/{order}', array(
    'as' => 'send',
    'uses' => 'SupplierController@getSend'
));

Route::get('/supplier/complete', array(
    'as' => 'complete',
    'uses' => 'SupplierController@getComplete'
));

Route::post('/supplier/scan', array(
    'as' => 'scan',
    'uses' => 'SupplierController@postScan'
));