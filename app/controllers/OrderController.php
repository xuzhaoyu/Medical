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
        $products = DB::table('product')
            ->select('id', 'MName', 'PName', 'SName', 'PSize', 'mode', 'FDAcode', 'FDAexpire')
            //->get();
            ->paginate(10);
        return View::make('Hospital.productList',compact('products'));
    }

    public function postNewItem()
    {
        date_default_timezone_set('Asia/Shanghai');
        $rand = (string)rand(1000,9999);

        $products = DB::table('product')
            ->select('id', 'MName', 'PName', 'PBarcode', 'PSize', 'mode', 'FDAcode', 'FDAexpire', 'SId')
            ->get();
        foreach ($products as $p) {
            $number = (int)Input::get($p -> id);
            if ($number > 0) {
                $HName = Cache::get('HName');
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
                    'PBarcode' => $p->PBarcode,
                    'HBarcode' => $barcode,
                    'expire' => '',
                    'HName' => Cache::get('HName'),
                    'HUser' => Cache::get('username'),
                    'SId' => $p->SId,
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
        $HName = Cache::get('HName');
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

    public function postSearch()
    {
        $s = Input::get() ["search"];
        $s = str_replace(" ", "%", $s);
        $items = DB::table('product')
            ->where('PName', 'LIKE', '%'.$s.'%')
            ->orWhere('SName', 'LIKE', '%'.$s.'%')
            ->select('id', 'MName', 'PName', 'SName', 'PBarcode', 'PSize', 'mode', 'FDAcode', 'FDAexpire')
            ->get();
        //return Redirect::to(URL::route('hospital-list'))->with('products', $items);
        return View::make('Hospital.productList')->with('products', $items);
    }

    public function postCart()
    {
        date_default_timezone_set('Asia/Shanghai');
        $orders = DB::table('orders')
            ->select('id')
            ->get();

        foreach ($orders as $p) {
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

        $orders = Orders::where('orderNum', '=', Input::get('id'))->groupBy('SId')->get(['SId']);
        foreach($orders as $order) {
            $email = User::where('id', '=', $order->SId)->first(['email']);
            $stuff = Orders::where('orderNum', '=', Input::get('id'))->where('SId', '=', $order->SId)->get();
            Mail::send('email', array('stuffs' => $stuff, 'email'), function($message) use ($email, $stuff)
            {
                $message->from('botenv@126.com', 'Laravel');
                $message->to($email->email, 'John Smith')->subject('订单: '.$stuff[0]->orderNum);
            });
            echo $stuff;
        }

        return Redirect::route('hospital-list')-> with('global', '已成功确认订单，并给代理商发送邮件');

    }
}