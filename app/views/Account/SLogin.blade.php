{{ Form::open(array('route' => 'supplier-login-post')) }}
{{ Form::label('username', '登录名:') }}
{{ Form::text('username') }}
<br>
{{ Form::label('password', '密码:') }}
{{ Form::text('password') }}
<br>
{{ Form::submit('确认') }}
{{ Form::close() }}