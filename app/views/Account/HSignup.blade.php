@extends('layouts.main')

@section('content')
{{ Form::open(array('route' => 'hospital-signup-post')) }}
{{ Form::label('HName', '医院名称:') }}
{{ Form::text('HName') }}
<br>
{{ Form::label('address', '地址ַ:') }}
{{ Form::text('address') }}
<br>
{{ Form::label('dept', '部门名称:') }}
{{ Form::text('dept') }}
<br>
{{ Form::label('username', '登录名:') }}
{{ Form::text('username') }}
<br>
{{ Form::label('password', '密码:') }}
{{ Form::password('password') }}
<br>
{{ Form::label('password_again', '再次输入密码:') }}
{{ Form::password('password_again') }}
<br>
{{ Form::label('phone', '电话:') }}
{{ Form::text('phone') }}
<br><br>
{{ Form::submit('确认') }}
{{ Form::close() }}
</html>
@stop