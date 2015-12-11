@extends('layouts.supplier')

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
        <title>未完成订单</title>
    </head>

    <body>

    @foreach ($nums as $num)
        订单号：{{$num->orderNum}} 订单日期：{{$num->OrderDate}} 发货日期：{{$num->SendDate}} 完成日期：{{$num->ReceivedDate}}
        状态：{{$num->status}} 订货机构：{{$num->HName}} 订货人：{{$num->HUser}} @if($num->status != 'sent')<a href ="{{URL::route('incomplete')}}/send/{{$num->id}}">发货</a> @endif
        <!-- <table>
            <tr>
                <th>产品名称</th>
                <th>产品编号</th>
                <th>医院产品名称</th>
                <th>过期日期</th>
                <th>数量</th>
            </tr> -->
            @foreach ($orders as $order)
                @if ($order->orderNum == $num->orderNum)
                    <br>
                    数量:{{$order->PCount}}
                    {{$order->MName}}
                    {{$order->PName}}
                    {{$order->PSize}}
                    {{$order->HBarcode}}
                    剩余数量: {{$order->PCount - $order->actual}}
                    {{ Form::open(array('route' => 'scan')) }}
                    {{ Form::text('product') }}
                    {{ Form::hidden('id', $order->id) }}
                    {{ Form::submit('确认') }}
                    {{ Form::close() }}
                    <!-- <tr>
                        <td>{{$order->PName}}</td>
                        <td>{{$order->PBarcode}}</td>
                        <td>{{$order->HBarcode}}</td>
                        <td>{{$order->expire}}</td>
                        <td>{{$order->PCount}}</td>
                    </tr> -->
                @endif
            @endforeach
        <!-- </table> -->
        <br>
        <br>
    @endforeach
    </body>
@stop