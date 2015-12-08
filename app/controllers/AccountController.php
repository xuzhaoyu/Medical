<?php

/**
 * Created by PhpStorm.
 * User: War_Archer
 * Date: 12/8/2015
 * Time: 12:33 PM
 */
class AccountController extends \BaseController
{
    public function getHLogin()
    {
        return View::make('account.HLogin');
    }

    public function postHLogin()
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

            $email = Input::get('email');
            $username = Input::get('username');
            $password = Input::get('password');

            $user = User::create(array(
                'username' => $username,
                'password' => $password,
            ));

            if ($user) {
                return Redirect::route('account-login')
                    ->with('global', 'Your account has already been created');
            }
        }
        $input = Input::all();
        dd($input['LoginName']);
    }

    public function getHSignup()
    {
        return View::make('account.HSignup');
    }

    public function postHSignup()
    {
        $input = Input::all();
        dd($input['LoginName']);
    }

    public function getSLogin()
    {
        return View::make('account.SLogin');
    }

    public function postSLogin()
    {
        $input = Input::all();
        dd($input['LoginName']);
    }

    public function getSSignup()
    {
        return View::make('account.SSignup');
    }

    public function postSSignup()
    {
        $input = Input::all();
        dd($input['LoginName']);
    }


}