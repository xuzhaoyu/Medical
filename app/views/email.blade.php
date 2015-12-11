订单号：{{$stuffs[0]->orderNum}} 订单日期：{{$stuffs[0]->OrderDate}} 订货机构：{{$stuffs[0]->HName}} 订货人：{{$stuffs[0]->HUser}}
@foreach($stuffs as $stuff)
    <br>
    数量:{{$stuff->PCount}}|
    {{$stuff->MName}}
    {{$stuff->PName}}
    {{$stuff->PSize}}
    {{$stuff->HBarcode}}
    @endforeach