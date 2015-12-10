<?php
/**
 * Created by PhpStorm.
 * User: War_Archer
 * Date: 12/8/2015
 * Time: 7:02 PM
 */
class SupplierController extends \BaseController{
    public function getIncomplete(){
        $inc = Orders::where('status','<>', 'complete')->orderBy('orderNum','DESC')->get();
        $num = Orders::where('status','<>', 'complete')->groupBy('orderNum')->orderBy('orderNum','DESC')->get();
        return View::make('Supplier.incomplete')->with('orders',$inc)->with('nums', $num);
    }

    public function getComplete(){
        $comp = Orders::where('status','=', 'complete')->orderBy('orderNum','DESC')->get();
        $num = Orders::where('status','=', 'complete')->groupBy('orderNum')->orderBy('orderNum','DESC')->get();
        //$page = Paginator::make($num, count($num), 1);
        return View::make('Supplier.complete')->with('orders',$comp)->with('nums', $num);
    }

    public function getSend($id){
        date_default_timezone_set('Asia/Shanghai');
        $date = date('Y-m-d H:i:s');
        $order =  Orders::find($id);
        $order->status = 'sent';
        $order->SendDate = $date;
        $order->save();
        return Redirect::to(URL::route('incomplete'));
    }

    public function postScan(){
        $input = Input::all();
        dd($input['id']);
    }
}