<html lang="zh-CN">
<head>
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/look.css') }}">
    <script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='{{asset('js/nprogress.js') }}'></script>
    <link rel='stylesheet' href='{{asset('css/nprogress.css') }}'/>
    <link rel="stylesheet" href="{{asset('css/style.css') }}" />
    <link rel="stylesheet" href="https://cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css" />
    <script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    @yield('import')
</head>
<body>
    <div role='bar'></div>
    @include('myflash::top-message')
    {{--@include('myflash::notification')--}}
    {{--@include('myflash::bottom-message')--}}
    <div style="background: rgba(246,246,246,1);">
        @yield('content')
    </div>
    <script>
        NProgress.start();
        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
    </script>
</body>
</html>