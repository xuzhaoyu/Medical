<style>
    ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
        font-size: 18px;
    }

    li {
        float: left;
        padding-right: 32px;
    }
</style>
<br>
<br>
<nav>
    <ul>
        <li><a href="{{ URL::route('hospital-list') }}">下订单</a></li>
        <li><a href="{{ URL::route('hospital-complete') }}">已下订单</a></li>
        <li><a href="{{ URL::route('hospital-cart') }}">购物车结算</a></li>
        <li><a href="{{ URL::route('account-logoff') }}">退出</a></li>
    </ul>
</nav>
<br>
<br>
<br>
<br>