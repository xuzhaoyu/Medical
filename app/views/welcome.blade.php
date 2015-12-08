@extends('layouts.main')

@section('content')
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
@stop

