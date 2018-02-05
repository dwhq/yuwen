<!DOCTYPE html>
<html lang="en-us">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" href="favicon.ico" />    <!--jquery库-->
    <script src="{{asset('js/admin/jquery.min.js') }}"></script>
    <!--bootstrap库-->
    <link href="{{asset('css/admin/bootstrap.min.css') }}" rel="stylesheet" />
    <script src="{{asset('js/admin/bootstrap/bootstrap.min.js') }}"></script>

    <!--页面加载进度条-->
    <link href="{{asset('css/admin/pace/dataurl.css') }}" rel="stylesheet" />
    <script src="{{asset('js/admin/pace/pace.min.js') }}"></script>
    <!--font-awesome字体库-->
    <link href="{{asset('css/admin/font-awesome.min.css') }}" rel="stylesheet"/>
    <!--jquery.hammer手势插件-->
    <script src="{{asset('js/admin/jquery.hammer/hammer.min.js') }}"></script>
    <script src="{{asset('js/admin/jquery.hammer/jquery.hammer.js') }}"></script>
    <!--主要写的css代码-->
    <link href="{{asset('css/admin/default.css') }}" rel="stylesheet" type="text/css" />
    <!--主要写的js代码-->
    <script src="{{asset('js/admin/default.js') }}" type="text/javascript"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle show pull-left" data-target="sidebar">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">网站后台管理</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="{{url('/')}}">网站前台</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button"
                       aria-expanded="false"><i class="fa fa-user fa-fw"></i>&nbsp;余温&nbsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li class=""><a href="#" style=" background: white;color: black">清楚缓存</a></li>
                        <li class="divider"></li>
                        <li class=""><a href="#" style=" background: white;color: black">退出登陆</a></li>
                        <li class="divider"></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container-fluid all">
    <div class="sidebar">
        <ul class="nav">
            <li>
                <!-- 利用data-target指定URL -->
                <a href="{{url('admin/info')}}" target="view_window"> <span class="glyphicon glyphicon-home"></span> &nbsp;网站信息</a>
            </li>
            <li>

            </li>
            <li class="has-sub">
                <a href="javascript:void(0);"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;文章列表<i class="fa fa-caret-right fa-fw pull-right"></i></a>
                <ul class="sub-menu">
                    <!-- 利用data-target指定URL -->
                    <li><a href="{{url('admin/article/list')}}" target="view_window"><i class="fa fa-circle-o fa-fw"></i>&nbsp;文章列表</a></li>
                    <li><a href="{{url('admin/articleList')}}" target="view_window"><i class="fa fa-circle-o fa-fw"></i>&nbsp;文章分类</a></li>
                    <li><a href="{{url('admin/article/create')}}" target="view_window"><i class="fa fa-circle-o fa-fw"></i>&nbsp;添加文章</a></li>
                </ul>
            </li>
        </ul>
    </div>
    <div class="maincontent row" style="height:1000px;">
        <iframe class="clearfix" style="height:100%;width: 100%;display: inline-table;"  src="{{url('admin/info')}}" scrolling="yes" name="view_window" ></iframe>

    </div>
</div>
<a href="#top" id="goTop"><i class="fa fa-angle-up fa-3x"></i></a>
</body>
</html>
