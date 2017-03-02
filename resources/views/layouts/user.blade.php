<!DOCTYPE html>
<html>
<head>
    <title>@yield('title') | FILGRAM</title>
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{url('assets/css/bootstrap-theme.min.css')}}">
    <link rel="stylesheet" href="{{url('assets/css/bootstrap.css')}}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    @yield('header-additional')
</head>
<body>
@include('partials.header_user')
<div class="container">
    <div class="row" style="margin-top: 80px">
        <div class="col-md-offset-2 col-md-8">
            @yield('content')
        </div>
    </div>
</div>
<script type="text/javascript" src="{{url('assets/js/jquery-1.12.3.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{url('assets/js/bootstrap-filestyle.js')}}"></script>
@yield('footer-additional')
</body>
</html>