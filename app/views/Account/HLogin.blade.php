{{ Form::open(array('route' => 'hospital-login-post')) }}
{{ Form::label('LoginName', '操作人登录名称:') }}
{{ Form::text('LoginName') }}
{{ Form::label('password', '密码:') }}
{{ Form::text('password') }}
{{ Form::submit('确认') }}
{{ Form::close() }}
