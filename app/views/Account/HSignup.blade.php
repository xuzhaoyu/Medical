@extends('layouts.main')

@section('content')
{{ Form::open(array('route' => 'hospital-signup-post')) }}
{{ Form::label('HName', '医院名称:') }}
{{ Form::text('HName') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('address', '地址ַ:') }}
{{ Form::text('address') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('dept', '科室:') }}
{{ Form::text('dept') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('username', '用户名:') }}
{{ Form::text('username') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('password', '密码:') }}
{{ Form::password('password') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('password_again', '再次输入密码:') }}
{{ Form::password('password_again') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('phone', '电话:') }}
{{ Form::text('phone') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('email', '电子邮箱:') }}
{{ Form::text('email') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br><br>
{{ Form::submit('确认') }}
{{ Form::close() }}
@stop