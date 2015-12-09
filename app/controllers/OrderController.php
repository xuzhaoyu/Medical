<?php

/**
 * Created by PhpStorm.
 * User: War_Archer
 * Date: 12/8/2015
 * Time: 12:33 PM
 */
class OrderController extends \BaseController{

    public function getList()
    {
        $p = DB::table('product')
            ->select('id', 'MName', 'PName', 'PSize', 'mode', 'FDAcode', 'FDAexpire')
            ->get();
        return View::make('Hospital.productList')->with('products', $p);
    }

    public function postNewItem()
    {
        date_default_timezone_set('Asia/Shanghai');
        $products = DB::table('product')
            ->select('id', 'MName', 'PName', 'PSize', 'mode', 'FDAcode', 'FDAexpire')
            ->get();

        foreach ($products as $p) {
            $number = (int)Input::get($p -> id);
            if ($number > 0) {
                $Hcode = DB::table('hospital_barcode')
                    -> where('PId', '=', $p -> id)
                    -> first();

                $item = Orders::create(array(
                    'orderNum' => '20151109000001',
                    'PName' => $p->PName,
                    'PBarcode' => '',
                    'HBarcode' => $Hcode->HBarcode,
                    'expire' => '',
                    'PCount' => $number,
                    'HId' => '1',
                    'HUser' => '王红霞1',
                    'SId' => '',
                    'SUser' => '',
                    'status' => 'ordered',
                    'OrderDate' => date('Y-m-d H:i:s'),
                    'SendDate' => '',
                    'ReceivedDate' => '',
                ));
            }
        }

        return Redirect::route('hospital-list')-> with('global', '商品已加入购物车');
    }

    public function getCart()
    {
        $p = DB::table('product')
            ->select('id', 'MName', 'PName', 'PSize', 'mode', 'FDAcode', 'FDAexpire')
            ->get();
        return View::make('Hospital.cart')->with('products', $p);
    }

    public function postCart()
    {
        dd();
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

}