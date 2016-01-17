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

搜产品/搜代理商名称：<form action=" {{ URL::route('hospital-list-search') }} " method="post">
<?php echo Form::text("search"); ?>

<input type="submit" value="搜索">
</form>
<br>

<?php //echo $products->links(); ?>

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
        <th>代理商名称</th>
        <th>规格</th>
        <th>货号</th>
    </tr>
    @foreach ($products as $p)
    <tr>
        <?php
        $name = Cache::get('username');
        $HName = Cache::get('HName');
        $h = DB::table('hospital_barcode')
            ->where('Pid', '=', $p->id)
            ->where('HName', '=', $HName)
            ->select('id', 'HBarcode')
            ->first();
        if (is_null($h)) $barcode = '未找到院内码'; else $barcode = $h->HBarcode;
        ?>
        <td>
            <?php echo Form::text($p->id, 0); ?></td>
        <td>{{$barcode}}</td>
        <td>{{$p->PName}}</td>
        <td>{{$p->MName}}</td>
        <td>{{$p->SName}}</td>
        <td>{{$p->PSize}}</td>
        <td>{{$p->Huohao}}</td>
    </tr>
    @endforeach
</table>
    {{$products->links()}}
    <table>
        <tr><th><input type="submit" value="提交全部订单"></th></tr>
    </table>
</form>
<br>
</body>

@stop





