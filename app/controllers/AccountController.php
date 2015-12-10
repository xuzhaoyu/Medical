<?php

/**
 * Created by PhpStorm.
 * User: War_Archer
 * Date: 12/8/2015
 * Time: 12:33 PM
 */
class AccountController extends \BaseController{

    public function welcome()
    {
        return View::make('welcome');
    }

    public function postLogin()
    {
        $email = Input::get('email');
        $password = Input::get('password');

//        dd(Hash::make(Input::get('password')));

        if (Auth::attempt(array('username' => $email, 'password' => $password), true))
            return Redirect::route('hospital-list');

        if (Auth::attempt(array('email' => $email, 'password' => $password), true))
            return View::make('supplier');

        return Redirect::route('account-login')-> with('global', '用户名或密码错误');
    }

    public function getHSignup()
    {
        return View::make('account.HSignup');
    }

    public function postHSignup()
    {
        $validator = Validator::make(Input::all(), array(
            'username' => 'required|max:20|unique:users',
            'password' => 'required|max:60|min:6',
            'password_again' => 'required|max:60|same:password',
            'HName' => 'required|max:60',
            'address' => 'required|max:60',
            'dept' => 'required|max:60',
            'phone' => 'required|max:60'
        ));

        if ($validator->fails()) {
            return Redirect::route('hospital-signup')
                ->withErrors($validator)
                ->withInput();
        } else {

            $user = User::create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'HName' => Input::get('HName'),
                'address' => Input::get('address'),
                'department' => Input::get('dept'),
                'phone' => Input::get('phone'),
                'email' => Input::get('email'),
            ));

            if ($user) {
                return Redirect::route('account-login')
                    ->with('global', '您的帐户已经被成功创建');
            }
        }
    }

    public function getSSignup()
    {
        return View::make('account.SSignup');
    }

    public function postSSignup()
    {
        $validator = Validator::make(Input::all(), array(
            'username' => 'required|max:60',
            'email' => 'required|max:60|unique:users',
            'password' => 'required|max:60|min:6',
            'password_again' => 'required|max:60|same:password',
            'SName' => 'required|max:60',
            'address' => 'required|max:60',
            'phone' => 'required|max:60'
        ));

        if ($validator->fails()) {
            return Redirect::route('supplier-signup')
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = User::create(array(
                'username' => Input::get('username'),
                'password' => Hash::make(Input::get('password')),
                'SName' => Input::get('SName'),
                'address' => Input::get('address'),
                'phone' => Input::get('phone'),
                'email' => Input::get('email'),
            ));

            if ($user) {
                return Redirect::route('account-login')
                    ->with('global', '您的帐户已经被成功创建');
            }
        }
    }


}