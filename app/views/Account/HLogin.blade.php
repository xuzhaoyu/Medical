{{ Form::open(array('route' => 'hospital-login-post')) }}
{{ Form::label('LoginName', '登录名:') }}
{{ Form::text('LoginName') }}
<br>
{{ Form::label('password', '密码:') }}
{{ Form::text('password') }}
<br>
{{ Form::submit('确认') }}
{{ Form::close() }}
