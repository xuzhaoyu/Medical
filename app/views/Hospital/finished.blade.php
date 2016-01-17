@extends('layouts.hospital')

@section('content')
    <style>
        table, th, td {
            border: 1px solid black;
            font-size: 27px;
            font-weight: 600;
        }

        th {
            background-color: #1e90ff;
            color: #2c3e50;
        }

        td {
            background-color: #94C5CC;
        }

        span {
            color: red;
        }

        a:link {
            color: #2c3e50;
        }

        a:visited {
            color: #2c3e50;
        }
    </style>
    <head>
        <meta charset="UTF-8">
        <title>完成订单</title>
    </head>

    <body>
    @foreach ($nums as $num)
        订单号：{{$num->orderNum}} 订单日期：{{$num->OrderDate}} 发货日期：{{$num->SendDate}} 完成日期：{{$num->ReceivedDate}}
        状态：{{$num->status}} 订货机构：{{$num->HId}} 订货人：{{$num->HUser}}
        <table>
            <tr>
                <th>产品名称</th>
                <th>产品编号</th>
                <th>医院产品名称</th>
                <th>过期日期</th>
                <th>数量</th>
            </tr>
            @foreach ($orders as $order)
                @if ($order->orderNum == $num->orderNum)
                    <tr>
                        <td>{{$order->PName}}</td>
                        <td>{{$order->PBarcode}}</td>
                        <td>{{$order->HBarcode}}</td>
                        <td>{{$order->expire}}</td>
                        <td>{{$order->PCount}}</td>
                    </tr>
                @endif
            @endforeach
        </table>
        <br>
    @endforeach
    </body>
@stop