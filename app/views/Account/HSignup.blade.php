/**
* Created by PhpStorm.
* User: War_Archer
* Date: 12/8/2015
* Time: 12:12 PM
*/

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
{{ Form::close() }} 