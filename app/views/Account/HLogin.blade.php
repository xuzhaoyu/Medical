{{ Form::open(array('route' => 'hospital-login-post')) }}
{{ Form::label('LoginName', '登录名:') }}
{{ Form::text('LoginName') }}
{{ Form::label('password', '密码:') }}
{{ Form::text('password') }}
{{ Form::submit('确认') }}
{{ Form::close() }}
