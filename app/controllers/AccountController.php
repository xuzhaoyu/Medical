<?php

/**
 * Created by PhpStorm.
 * User: War_Archer
 * Date: 12/8/2015
 * Time: 12:33 PM
 */
class AccountController extends \BaseController{

    public function postLogin()
    {
        $email = Input::get('email');
        $password = Input::get('password');

//        dd(Hash::make(Input::get('password')));

        $h = DB::table('hospital')
            ->where('username', '=', $email)
            ->select('username', 'password')
            ->first();

        $s = DB::table('supplier')
            ->where('email', '=', $email)
            ->select('username', 'password')
            ->first();

        if ((!is_null($h)) && (Hash::check($password, $h->password))) return View::make('hospital');
        if ((!is_null($s)) && (Hash::check($password, $s->password))) return View::make('supplier')->with('name',$s);

        return Redirect::route('account-login')-> with('global', '用户名或密码错误');
    }

    public function getHSignup()
    {
        return View::make('account.HSignup');
    }

    public function postHSignup()
    {
        $validator = Validator::make(Input::all(), array(
            'username' => 'required|max:20|unique:hospital',
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

            $user = Hospital::create(array(
                'username' => Input::get('username'),
                'password' => Input::get('password'),
                'HName' => Input::get('HName'),
                'address' => Input::get('address'),
                'department' => Input::get('dept'),
                'phone' => Input::get('phone'),
                'email' => Input::get('email'),
            ));

            if ($user) {
                return Redirect::route('account-login')
                    ->with('global', 'Your account has already been created');
            }
        }
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