{{ Form::open(array('route' => 'hospital-login-post')) }}
{{ Form::label('LoginName', '�����˵�¼����:') }}
{{ Form::text('LoginName') }}
{{ Form::label('password', '����:') }}
{{ Form::text('password') }}
{{ Form::submit('ȷ��') }}
{{ Form::close() }}
