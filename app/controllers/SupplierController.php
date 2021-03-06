<?php

/**
 * Created by PhpStorm.
 * User: War_Archer
 * Date: 12/8/2015
 * Time: 7:02 PM
 */
class SupplierController extends \BaseController
{
    public function getIncomplete()
    {
        $inc = Orders::where('status', '=', 'ordered')->orderBy('orderNum', 'DESC')->get();
        $num = Orders::where('status', '=', 'ordered')->groupBy('orderNum')->orderBy('orderNum', 'DESC')->get();
        return View::make('Supplier.incomplete')->with('orders', $inc)->with('nums', $num);
    }

    public function getComplete()
    {
        $comp = Orders::where('status', '=', 'sent')->orderBy('orderNum', 'DESC')->get();
        $num = Orders::where('status', '=', 'sent')->groupBy('orderNum')->orderBy('orderNum', 'DESC')->get();
        //$page = Paginator::make($num, count($num), 1);
        return View::make('Supplier.complete')->with('orders', $comp)->with('nums', $num);
    }

    public function getSend($id)
    {
        date_default_timezone_set('Asia/Shanghai');
        $date = date('Y-m-d H:i:s');
        $order = Orders::find($id);
        $order->status = 'sent';
        $order->SendDate = $date;
        $order->save();
        return Redirect::to(URL::route('incomplete'));
    }

    public function postScan()
    {
        $input = Input::get();
        $barcode = $input['product'];
        $type = '';
        date_default_timezone_set('Asia/Shanghai');

        if (array_key_exists('mac', $input)) {
            $scanner = DB::table('scanner')->where('mac', '=', $input['mac'])->first();
            $id = $scanner->userId;
            $username = $scanner->username;
        } else
        {
            $id = Cache::get('id');
            $username = Cache::get('username');
        }

        if (strcmp(substr($barcode, 0, 2), '01') == 0) $type = 'GS1-128-primary';
        else if (strcmp(substr($barcode, 0, 2), '17') == 0) $type = 'GS1-128-secondary';
        else if ($barcode[0] == '+') $type = 'HIBC';
        else if ((strlen($barcode) == 13) && ($barcode[0] == '6')) $type = 'EAN-13';

        if (strcmp($type, 'GS1-128-primary') == 0) {
            Cache::put('PBarPrimary', $barcode, 10);
            $a = array('Mcode' => substr($barcode, 3, 8),
                'huohao' => substr($barcode, 12, 4));
        } else if (strcmp($type, 'GS1-128-secondary') == 0) {
            $PBarPrimary = Cache::get('PBarPrimary');
            Cache::forget('PBarPrimary');
            $order = Orders::where('PBarcode', '=', $PBarPrimary)->where('SId', '=', $id)->first();
            if ((int)$order->PCount <= (int)$order->actual) {
                //Scanner Cannot go into Redirect without proper Cookies
                if (!array_key_exists('mac', $input)) return Redirect::to(URL::route('incomplete'));
                else return;
            }

            $date_start = strpos($barcode, '17') + 2;
            $date_length = 6;
            $date = date_create_from_format('Ymd H:i:s', '20' . substr($barcode, $date_start, $date_length) . ' 00:00:00');
            $lot_start = strpos($barcode, '10') + 2;
            if ((strpos($barcode, '91')) || (strpos($barcode, '21'))) {
                if (strpos($barcode, '91')) {
                    $lot_length = strpos($barcode, '91') - strpos($barcode, '10') - 2;
                    $lot = substr($barcode, $lot_start, $lot_length);
                    $serial_start = strpos($barcode, '91') + 2;
                    $serial = substr($barcode, $serial_start);
                } else {
                    $lot_length = strpos($barcode, '21') - strpos($barcode, '10') - 2;
                    $lot = substr($barcode, $lot_start, $lot_length);
                    $serial_start = strpos($barcode, '21') + 2;
                    $serial = substr($barcode, $serial_start);
                }
            } else {
                $lot = substr($barcode, $lot_start);
                $serial = ' ';
            }

            SecondaryBar::create(array(
                'orderNum' => $order->orderNum,
                'PBarcode' => $order->PBarcode,
                'PBarSecondary' => $barcode,
                'expire' => date_format($date, 'Y-m-d H:i:s'),
                'lot' => $lot,
                'SerialNum' => $serial
            ));
            $order->SUser = $username;
            $order->actual = $order->actual + 1;
            $order->save();

        } else if (strcmp($type, 'HIBC') == 0) {
            if (strcmp(substr($barcode, 0, 2), '+H') == 0) {
                Cache::put('PBarPrimary', $barcode, 10);
            } else {
                $PBarPrimary = Cache::get('PBarPrimary');
                Cache::forget('PBarPrimary');
                $order = Orders::where('PBarcode', '=', $PBarPrimary)->where('SId', '=', $id)->first();
                if ((int)$order->PCount <= (int)$order->actual) {
                    //Scanner Cannot go into Redirect without proper Cookies
                    if (!array_key_exists('mac', $input)) return Redirect::to(URL::route('incomplete'));
                    else return;
                }

                $exp = '0000-00-00 00:00:00';
                if ($barcode[1] != '$') {
                    $len = strlen($barcode) - 8;
                    $exp = date_create_from_format('z Y', substr($barcode, 3, 3) . ' 20' . substr($barcode, 1, 2));
                    $lot = substr($barcode, 6, $len);
                } else if ($barcode[1] == '$' && $barcode[2] != '$') {
                    $len = strlen($barcode) - 4;
                    $lot = substr($barcode, 2, $len);
                } else if ($barcode[1] == '$' && $barcode[2] == '$' && $barcode[3] != '+') {
                    switch ($barcode[3]) {
                        case '2':
                            $len = strlen($barcode) - 12;
                            $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 8, 2) . '-' . substr($barcode, 4, 2) . '-' . substr($barcode, 6, 2));
                            $lot = substr($barcode, 10, $len);
                            break;
                        case '3':
                            $len = strlen($barcode) - 12;
                            $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 4, 2) . '-' . substr($barcode, 6, 2) . '-' . substr($barcode, 8, 2));
                            $lot = substr($barcode, 10, $len);
                            break;
                        case '4':
                            $len = strlen($barcode) - 14;
                            $exp = date_create_from_format('Y-m-d H', '20' . substr($barcode, 4, 2) . '-' . substr($barcode, 6, 2) . '-' . substr($barcode, 8, 2) . ' ' . substr($barcode, 10, 2));
                            $lot = substr($barcode, 12, $len);
                            break;
                        case '5':
                            $len = strlen($barcode) - 11;
                            $exp = date_create_from_format('z Y', substr($barcode, 6, 3) . ' 20' . substr($barcode, 4, 2));
                            $lot = substr($barcode, 9, $len);
                            break;
                        case '6':
                            $len = strlen($barcode) - 13;
                            $exp = date_create_from_format('z Y H', substr($barcode, 6, 3) . ' 20' . substr($barcode, 4, 2) . ' ' . substr($barcode, 9, 2));
                            $lot = substr($barcode, 11, $len);
                            break;
                        case '7':
                            $len = strlen($barcode) - 6;
                            $lot = substr($barcode, 4, $len);
                            break;
                        case '8':
                            switch ($barcode[6]) {
                                case '2':
                                    $len = strlen($barcode) - 15;
                                    $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 11, 2) . '-' . substr($barcode, 7, 2) . '-' . substr($barcode, 9, 2));
                                    $lot = substr($barcode, 13, $len);
                                    break;
                                case '3':
                                    $len = strlen($barcode) - 15;
                                    $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 7, 2) . '-' . substr($barcode, 9, 2) . '-' . substr($barcode, 11, 2));
                                    $lot = substr($barcode, 13, $len);
                                    break;
                                case '4':
                                    $len = strlen($barcode) - 17;
                                    $exp = date_create_from_format('Y-m-d H', '20' . substr($barcode, 7, 2) . '-' . substr($barcode, 9, 2) . '-' . substr($barcode, 11, 2) . ' ' . substr($barcode, 13, 2));
                                    $lot = substr($barcode, 15, $len);
                                    break;
                                case '5':
                                    $len = strlen($barcode) - 14;
                                    $exp = date_create_from_format('z Y', substr($barcode, 9, 3) . ' 20' . substr($barcode, 7, 2));
                                    $lot = substr($barcode, 12, $len);
                                    break;
                                case '6':
                                    $len = strlen($barcode) - 16;
                                    $exp = date_create_from_format('z Y H', substr($barcode, 9, 3) . ' 20' . substr($barcode, 7, 2) . ' ' . substr($barcode, 12, 2));
                                    $lot = substr($barcode, 14, $len);
                                    break;
                                case '7':
                                    $len = strlen($barcode) - 9;
                                    $lot = substr($barcode, 7, $len);
                                    break;
                                default:
                                    $len = strlen($barcode) - 12;
                                    $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 8, 2) . '-' . substr($barcode, 6, 2) . '-1');
                                    $lot = substr($barcode, 10, $len);
                            }
                            break;
                        case '9':
                            switch ($barcode[9]) {
                                case '2':
                                    $len = strlen($barcode) - 18;
                                    $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 14, 2) . '-' . substr($barcode, 10, 2) . '-' . substr($barcode, 12, 2));
                                    $lot = substr($barcode, 16, $len);
                                    break;
                                case '3':
                                    $len = strlen($barcode) - 18;
                                    $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 10, 2) . '-' . substr($barcode, 12, 2) . '-' . substr($barcode, 14, 2));
                                    $lot = substr($barcode, 16, $len);
                                    break;
                                case '4':
                                    $len = strlen($barcode) - 20;
                                    $exp = date_create_from_format('Y-m-d H', '20' . substr($barcode, 10, 2) . '-' . substr($barcode, 12, 2) . '-' . substr($barcode, 14, 2) . ' ' . substr($barcode, 16, 2));
                                    $lot = substr($barcode, 18, $len);
                                    break;
                                case '5':
                                    $len = strlen($barcode) - 17;
                                    $exp = date_create_from_format('z Y', substr($barcode, 12, 3) . ' 20' . substr($barcode, 10, 2));
                                    $lot = substr($barcode, 15, $len);
                                    break;
                                case '6':
                                    $len = strlen($barcode) - 19;
                                    $exp = date_create_from_format('z Y H', substr($barcode, 12, 3) . ' 20' . substr($barcode, 10, 2) . ' ' . substr($barcode, 15, 2));
                                    $lot = substr($barcode, 17, $len);
                                    break;
                                case '7':
                                    $len = strlen($barcode) - 12;
                                    $lot = substr($barcode, 10, $len);
                                    break;
                                default:
                                    $len = strlen($barcode) - 15;
                                    $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 11, 2) . '-' . substr($barcode, 9, 2) . '-1');
                                    $lot = substr($barcode, 13, $len);
                            }
                            break;
                        default:
                            $len = strlen($barcode) - 9;
                            $exp = date_create_from_format('Y-m-d', '20' . substr($barcode, 5, 2) . '-' . substr($barcode, 3, 2) . '-1');
                            $lot = substr($barcode, 7, $len);
                    }
                } else {
                    dd('HIBC Secondary $$+');
                }

                SecondaryBar::create(array(
                    'orderNum' => $order->orderNum,
                    'PBarcode' => $order->PBarcode,
                    'PBarSecondary' => $barcode,
                    'expire' => $exp,
                    'lot' => $lot,
                ));
                $order->SUser = $username;
                $order->actual = $order->actual + 1;
                $order->save();
            }
        } else if (strcmp($type, 'EAN-13') == 0) dd($type);

        //Scanner Cannot go into Redirect without proper Cookies
        if (!array_key_exists('mac', $input)) return Redirect::to(URL::route('incomplete'));
    }
}