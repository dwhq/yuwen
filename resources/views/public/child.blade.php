<html>
<head>
    <title> @yield('title')</title>
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/look.css') }}">
    <script src='{{asset('js/jquery-1.8.3.min.js') }}'></script>
    <script src='{{asset('js/nprogress.js') }}'></script>
    <link rel='stylesheet' href='{{asset('css/nprogress.css') }}'/>
</head>
<body>
<div role='bar'></div>
<div style="background: rgba(246,246,246,1);">
    @yield('content')
</div>
<script>
    NProgress.start();
    setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
</script>
</body>
</html>