@extends('layouts.supplier')

@section('content')
<head>
	<meta charset="UTF-8">
	<title>供应商</title>
</head>

<body>
{{Auth::user()->username}}用户你好
</body>
@stop
