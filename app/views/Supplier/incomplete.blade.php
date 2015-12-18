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
订单号：{{$num->orderNum}} 订单日期：{{$num->SendDate}} 状态：{{$num->status}}
订货机构：{{$num->HName}} 订货人：{{$num->HUser}}

@if($num->status != 'sent') <ahref="{{URL::route('incomplete')}}/send/{{$num->id}}">发货</a>
@endif
    @foreach ($orders as $order)
    @if ($order->orderNum == $num->orderNum)
    <br>
    数量:{{$order->PCount}}|
    {{$order->MName}}
    {{$order->PName}}
    {{$order->PSize}}
    {{$order->PBarcode}}
    {{$order->HBarcode}}
    剩余数量: {{$order->PCount - $order->actual}}
    <?php
        $codes = DB::table('secondary_barcode')
        ->where('orderNum', '=', $order->orderNum)
        ->where('PBarcode', '=', $order->PBarcode)
        ->select('PBarcode', 'PBarSecondary')
        ->get();
    ?>
    <br><br> 条码：<br>
        @foreach ($codes as $s)
        {{$s->PBarcode}}
        -----
        {{$s->PBarSecondary}}
        <br>
        @endforeach
    @endif
    @endforeach
<br>
<br>
@endforeach
{{ Form::open(array('route' => 'scan')) }}
条码：{{ Form::text('product') }} <br>
<?php //MAC：{{ Form::text('mac') }} ?>
{{ Form::submit('确认') }}
{{ Form::close() }}
</body>
@stop


