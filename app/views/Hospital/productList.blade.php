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

<form action=" {{ URL::route('hospital-list-post') }} " method="post">
<table>
    <tr><th><input type="submit" value="提交全部订单"></th></tr>
</table>

<table>
    <tr>
        <th>数量</th>
        <th>院内码</th>
        <th>产品名称</th>
        <th>厂家名称</th>
        <th>规格</th>
        <th>管理模式</th>
        <th>注册证号</th>
        <th>注册到期日</th>
    </tr>
    @foreach ($products as $p)
    <tr>
        <?php
        $Hid = DB::table('hospital_barcode')
            ->where('Pid', '=', $p->id)
            ->select('id', 'HBarcode')
            ->first();
        ?>
        <td><?php echo Form::text($p->id, 0); ?></td>
        <td>{{$Hid->HBarcode}}</td>
        <td>{{$p->PName}}</td>
        <td>{{$p->MName}}</td>
        <td>{{$p->PSize}}</td>
        <td>{{$p->mode}}</td>
        <td>{{$p->FDAcode}}</td>
        <td>{{$p->FDAexpire}}</td>
    </tr>
    @endforeach
</table>

    <table>
        <tr><th><input type="submit" value="提交全部订单"></th></tr>
    </table>
</form>
<br>
</body>

@stop




