<html lang="zh-CN">
<head>
    <title> @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" type="text/css" href="{{asset('css/look.css') }}">
    <script src="//cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src='{{asset('js/nprogress.js') }}'></script>
    <link rel='stylesheet' href='{{asset('css/nprogress.css') }}'/>
    <link rel="stylesheet" href="{{asset('css/style.css') }}" />
    <link rel="stylesheet" href="{{asset('css/style.css') }}" />
    <link rel="stylesheet" href="//cdn.bootcss.com/ionicons/2.0.1/css/ionicons.min.css" />
    <script src="//cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link href="//cdn.bootcss.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('layui/css/layui.css') }}" />
    <script src="{{asset('layui/layui.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('Smartmd::head')
    {{--@include('Smartmd::php-parse')--}}
    @yield('import')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
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
        NProgress.start()
        setTimeout(function() { NProgress.done(); $('.fade').removeClass('out'); }, 1000);
    </script>
</body>
<script>
    var _hmt = _hmt || [];
    (function() {
        var hm = document.createElement("script");
        hm.src = "https://hm.baidu.com/hm.js?f9d98324805485a927839ff3df6aaf81";
        var s = document.getElementsByTagName("script")[0];
        s.parentNode.insertBefore(hm, s);
    })();
</script>
</html>