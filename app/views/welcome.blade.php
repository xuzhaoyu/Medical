<!DOCTYPE html>
<html>
    <head>
        <title>Medical</title>
    </head>
    <body>
    <a href="{{ URL::route('hospital-signup') }}">医院注册</a>
    <a href="{{ URL::route('supplier-signup') }}">供货商注册</a>

    <form action=" {{ URL::route('account-login-post') }} " method="post">
        <div>
            Email/用户名: <input type="text" name="email"
                    {{ (Input::old('email')) ? (' value="' . e(Input::old('email')) . '"') : ('') }}>
            @if ($errors->has())
                {{ $errors->first("email") }}
            @endif
        </div>
        <div>
            请输入密码: <input type="password" name="password">
            @if ($errors->has())
                {{ $errors->first("password") }}
            @endif
        </div>
        <br>
        <input type="submit" value="登录">
        {{ Form::token() }}
    </form>
    </body>
</html>
