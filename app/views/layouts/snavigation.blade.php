<style>
ul{
    list-style-type: none;
    padding:0;
    margin:0;
    font-size:27px;
  }
li{
    float:left;
    padding-right: 32px;
}
</style>
<br>
<br>
<nav>
    <ul>
        <li><a href="{{ URL::route('incomplete') }}">未完成的订单</a></li>
        <li><a href="{{ URL::route('complete') }}">完成的订单</a></li>
        <li><a href="{{ URL::route('account-logoff') }}">退出</a></li>
    </ul>
</nav>
<br>
<br>
<br>
<br>
