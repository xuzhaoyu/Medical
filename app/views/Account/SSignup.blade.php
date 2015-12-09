@extends('layouts.main')

@section('content')

{{ Form::open(array('route' => 'supplier-signup-post')) }}
{{ Form::label('SName', '供货商名称:') }}
{{ Form::text('SName') }}
@if ($errors->has())
{{ $errors->first("SName") }}
@endif
<br>
{{ Form::label('address', '地址ַ:') }}
{{ Form::text('address') }}
@if ($errors->has())
{{ $errors->first("address") }}
@endif
<br>
{{ Form::label('username', '操作人员:') }}
{{ Form::text('username') }}
@if ($errors->has())
{{ $errors->first("username") }}
@endif
<br>
{{ Form::label('password', '密码:') }}
{{ Form::password('password') }}
@if ($errors->has())
{{ $errors->first("password") }}
@endif
<br>
{{ Form::label('password_again', '再次输入密码:') }}
{{ Form::password('password_again') }}
@if ($errors->has())
{{ $errors->first("password_again") }}
@endif
<br>
{{ Form::label('phone', '电话:') }}
{{ Form::text('phone') }}
@if ($errors->has())
{{ $errors->first("phone") }}
@endif
<br>
{{ Form::label('email', '电子邮箱:') }}
{{ Form::text('email') }}
@if ($errors->has())
{{ $errors->first("email") }}
@endif
<br><br>
{{ Form::submit('确认') }}
{{ Form::close() }}
@stop