{{ Form::open(array('route' => 'hospital-signup-post')) }}
{{ Form::label('HName', 'ҽԺ����:') }}
{{ Form::text('HName') }}
{{ Form::label('address', '��ַ:') }}
{{ Form::text('address') }}
{{ Form::label('UName', '����������:') }}
{{ Form::text('UName') }}
{{ Form::label('LoginName', '�����˵�¼����:') }}
{{ Form::text('LoginName') }}
{{ Form::label('password', '����:') }}
{{ Form::text('password') }}
{{ Form::label('phone', '�绰:') }}
{{ Form::text('phone') }}
{{ Form::submit('ȷ��') }}
{{ Form::close() }}