/**
* Created by PhpStorm.
* User: War_Archer
* Date: 12/8/2015
* Time: 12:12 PM
*/

{{ Form::open(array('route' => 'hospital-signup-post')) }}
{{ Form::label('HName', '医院名称:') }}
{{ Form::text('HName') }}
{{ Form::label('address', '地址:') }}
{{ Form::text('address') }}
{{ Form::label('UName', '操作人名称:') }}
{{ Form::text('UName') }}
{{ Form::label('LoginName', '操作人登录名称:') }}
{{ Form::text('LoginName') }}
{{ Form::label('password', '密码:') }}
{{ Form::text('password') }}
{{ Form::label('phone', '电话:') }}
{{ Form::text('phone') }}
{{ Form::close() }} 