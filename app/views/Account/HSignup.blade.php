{{ Form::open(array('route' => 'hospital-signup-post')) }}
{{ Form::label('HName', '医院名称:') }}
{{ Form::text('HName') }}
{{ Form::label('address', '地址ַ:') }}
{{ Form::text('address') }}
{{ Form::label('UName', '操作人员名称:') }}
{{ Form::text('UName') }}
{{ Form::label('LoginName', '登录名:') }}
{{ Form::text('LoginName') }}
{{ Form::label('password', '密码:') }}
{{ Form::text('password') }}
{{ Form::label('phone', '电话:') }}
{{ Form::text('phone') }}
{{ Form::submit('确认') }}
{{ Form::close() }}