<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | FILGRAM</title>
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/sb-admin-2.css')}}">
    <link rel="stylesheet" href="{{url('assets/font-awesome/css/font-awesome.min.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @yield('header-additional')
</head>
<body>
@include('partials.header_user')
@include('partials.header_admin')

    <div class="row" style="margin-top: 40px">

            @yield('content')
        
    </div>

<script type="text/javascript" src="{{url('assets/js/jquery-1.12.3.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/sb-admin-2.js')}}"></script>

@yield('footer-additional')
</body>
</html>