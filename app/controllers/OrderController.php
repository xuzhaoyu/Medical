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
        $rand = (string)rand(1000,9999);

        $products = DB::table('product')
            ->select('id', 'MName', 'PName', 'PSize', 'mode', 'FDAcode', 'FDAexpire')
            ->get();
        foreach ($products as $p) {
            $number = (int)Input::get($p -> id);
            if ($number > 0) {
                $HName = Auth::user()->HName;
                $h = DB::table('hospital_barcode')
                    ->where('Pid', '=', $p->id)
                    ->where('HName', '=', $HName)
                    ->select('id', 'HBarcode')
                    ->first();
                if (is_null($h)) $barcode = '未找到院内码'; else $barcode = $h->HBarcode;

                $items = Orders::create(array(
                    'orderNum' => (string)date('YmdHi') . $rand,
                    'MName' => $p->MName,
                    'PName' => $p->PName,
                    'PSize' => $p->PSize,
                    'PCount' => $number,
                    'PBarcode' => '',
                    'HBarcode' => $barcode,
                    'expire' => '',
                    'HName' => Auth::user()->HName,
                    'HUser' => Auth::user()->username,
                    'SId' => '',
                    'SUser' => '',
                    'status' => 'pending',
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
        $HName = Auth::user() -> HName;
        $p = DB::table('orders')
            ->where('HName', '=', $HName)
            ->where('status', '=', 'pending')
            ->get();
        return View::make('Hospital.cart')->with('orders', $p);
    }

    public function getCartDelete($order_id)
    {
        DB::table('orders')
            ->where('id', '=', $order_id)
            ->delete();
        return Redirect::to(URL::route('hospital-cart'));
    }

    public function postCart()
    {
        date_default_timezone_set('Asia/Shanghai');
        $products = DB::table('product')
            ->select('id')
            ->get();
        foreach ($products as $p) {
            $number = (int)Input::get($p -> id);
            if ($number > 0) {
                $items = Orders::where('id', '=', $p -> id)->update(array(
                    'PCount' => $number,
                    'status' => 'ordered',
                    'SendDate' => date('Y-m-d H:i:s')
                ));
            }
        }
        return Redirect::route('hospital-list')-> with('global', '已成功确认订单，并给代理商发送邮件');
    }
}