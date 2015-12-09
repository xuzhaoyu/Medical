<!DOCTYPE html>


<html>
<head>
    <title> 医疗器械自动下单系统 </title>
</head>

<body>
@include('layouts.hospitalnav')

@if (Session::has('global'))
<p>{{ Session::get('global') }}</p>
@endif

@yield('content')
</body>
</html>