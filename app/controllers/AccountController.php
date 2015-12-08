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
        $input = Input::all();
        dd($input['LoginName']);
    }

    public function getHSignup()
    {
        return View::make('home');
    }

    public function postHSignup()
    {
        return View::make('home');
    }

    public function getSLogin()
    {
        return View::make('home');
    }

    public function postSLogin()
    {
        return View::make('home');
    }

    public function getSSignup()
    {
        return View::make('home');
    }

    public function postSSignup()
    {
        return View::make('home');
    }


}