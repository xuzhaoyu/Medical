@extends('layouts.hospital')

@section('content')

<style>
    table, th, td {
        border: 1px solid black;
        font-size: 15px;
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

<body>

@if (count($orders) == 0)
您的购物车是空的
@else
请再次确认订单并发送
<form action=" {{ URL::route('hospital-cart-post') }} " method="post">
    <table>
        <tr><th><input type="submit" value="确认下单"></th></tr>
    </table>

    <table>
        <tr>
            <th></th>
            <th>数量</th>
            <th>院内码</th>
            <th>产品名称</th>
            <th>厂家名称</th>
            <th>规格</th>
        </tr>
        @foreach ($orders as $p)
        <tr>
            <td><a href="{{URL::route('hospital-cart')}}/delete/{{$p->id}}">删除产品</a></td>
            <td><?php
                $number = $p->PCount;
                echo Form::text($p->id, $number);
            ?>
                {{ Form::hidden('id', $p->orderNum) }}
            </td>
            <td>{{$p->HBarcode}}</td>
            <td>{{$p->PName}}</td>
            <td>{{$p->MName}}</td>
            <td>{{$p->PSize}}</td>
        </tr>
        @endforeach
    </table>

    <table>
        <tr><th><input type="submit" value="确认下单"></th></tr>
    </table>
</form>
<br>
</body>
@endif
@stop





