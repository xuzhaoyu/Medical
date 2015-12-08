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
        <li><a href="{{ URL::route('account-login') }}">登录</a></li>
        <li><a href="{{ URL::route('hospital-signup') }}">医院注册</a></li>
        <li><a href="{{ URL::route('supplier-signup') }}">供货商注册</a></li>
    </ul>
</nav>
<br>
<br>
<br>
<br>