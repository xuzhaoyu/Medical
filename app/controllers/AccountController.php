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