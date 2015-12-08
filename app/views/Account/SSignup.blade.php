{{ Form::open(array('route' => 'supplier-signup-post')) }}
{{ Form::label('HName', '供货商名称:') }}
{{ Form::text('HName') }}
<br>
{{ Form::label('address', '地址ַ:') }}
{{ Form::text('address') }}
<br>
{{ Form::label('UName', '操作人员名称:') }}
{{ Form::text('UName') }}
<br>
{{ Form::label('LoginName', '登录名:') }}
{{ Form::text('LoginName') }}
<br>
{{ Form::label('password', '密码:') }}
{{ Form::text('password') }}
<br>
{{ Form::label('phone', '电话:') }}
{{ Form::text('phone') }}
<br>
{{ Form::label('email', '电子邮箱:') }}
{{ Form::text('email') }}
<br>
{{ Form::submit('确认') }}
{{ Form::close() }}