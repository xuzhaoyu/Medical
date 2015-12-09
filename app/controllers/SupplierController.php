<?php
/**
 * Created by PhpStorm.
 * User: War_Archer
 * Date: 12/8/2015
 * Time: 7:02 PM
 */
class SupplierController extends \BaseController{
    public function getIncomplete(){
        $inc= Orders::where('status','<>', 'complete')->orderBy('orderNum','DESC')->get();
        $num= Orders::where('status','<>', 'complete')->groupBy('orderNum')->orderBy('orderNum','DESC')->get();
        return View::make('Supplier.incomplete')->with('orders',$inc)->with('nums', $num);
    }

    public function getComplete(){
        $comp= Orders::where('status','=', 'complete')->orderBy('orderNum','DESC')->get();
        $num= Orders::where('status','=', 'complete')->groupBy('orderNum')->orderBy('orderNum','DESC')->get();
        return View::make('Supplier.complete')->with('orders',$comp)->with('nums', $num);
    }
}