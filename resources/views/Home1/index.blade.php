<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">--}}
    <script src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
    <style>
        {{--初始化css样式--}}
        body, h1, h2, h3, h4, h5, h6, hr, p, blockquote, dl, dt, dd, ul, ol, li, pre, form, fieldset, legend, button, input, textarea, th, td {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            padding: 29 px00;
            font: 14px "\5B8B\4F53", sans-serif;
            background: #ffffff;
        }

        h1, h2, h3, h4, h5, h6 {
            font-size: 100%;
        }

        address, cite, dfn, em, var {
            font-style: normal;
        }

        code, kbd, pre, samp {
            font-family: couriernew, courier, monospace;
        }

        small {
            font-size: 12px;
        }

        ul, ol {
            list-style: none;
        }

        a {
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        sup {
            vertical-align: text-top;
        }

        sub {
            vertical-align: text-bottom;
        }

        legend {
            color: #000;
        }

        fieldset, img {
            border: 0;
        }

        button, input, select, textarea {
            font-size: 100%;
        }

        table {
            border-collapse: collapse;
            border-spacing: 0;
        }
    </style>
    <style>
        a {
            color: #0C0C0C;
        }

        .content {
            margin: 0 13% 0 13%
        }
        .active {
            background-color: #2869df;
            border-radius: 5px;
            color: #ffffff;
        }
        .hue {
            color: #37424d;
        }
        a:hover{text-decoration:none}
    </style>
</head>
<body>
<div>
    <div id="blog" style="width: 100%;background:url('{{asset('/image/blog_03.jpg')}}');">
        <div class="content">
            <div style="height: 14px;padding-top: 14px;">
                <div style="float:left;font-family: PingFangSC-Medium;font-weight: normal;font-stretch: normal;letter-spacing: 4px; color: #37424d;">
                    •PHP交流学习中心•
                </div>
                <div class="clearfix"
                     style="text-align:center;float:right;width: 72px;line-height:30px;height: 30px;background-color: #2869df;font-size: 12px;color: #ffffff;box-shadow: 0px 10px 12px 0px rgba(10, 30, 68, 0.2);border-radius: 5px;">
                    登录
                </div>
                <div>
                    <div style="width:135px;letter-spacing: 4px;color: #e0e3e4;margin: 760px auto 28px auto">
                        下拉展开新世界!
                    </div>
                    <img class="center-block" onclick="btn()"
                         style="width: 58px;height: 58px;box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);margin: 0 auto"
                         src="{{asset('image/down.png')}}" alt="">
                </div>
            </div>
        </div>
    </div>
    <div id="nav"
         style="height: 66px;background-color: #ffffff;box-shadow: 0px 6px 15px 0px rgba(10, 30, 68, 0.15);border-radius: 10px;">
        <div class="content row" style="margin-top: 15px">
            <div class="log col-md-2">
                <img src="{{asset('image/log.jpg')}}" alt="指尖余温">
            </div>
            <div class="col-md-8">
                @foreach($colum as $vo)
                    <a href="{{url('home/'.$vo->type)}}" @if($vo->type==$type) class="active text-center"
                       @endif class="text-center hue"
                       style="float:right;width:140px;line-height:50px;height: 50px;">{{$vo->name}}</a>
                    {{--<div  class="col-md-1" style="background-color: #2869df;width: 140px;height: 50px; "><a @if($vo->type==$type) class="active"@endif href="{{url('home/'.$vo->type)}}" style="overflow: hidden;width: 140px;height: 50px; letter-spacing: 0px; color: #37424d;">{{$vo->name}}</a></div>--}}
                @endforeach
            </div>
            <div class="col-md-2">
                <form action="{{url('search')}}" method="get">
                    <input type="text" placeholder="&nbsp;&nbsp;&nbsp;&nbsp;输入关键字搜索" style="width: 231px;;
                    height: 40px;
                    border: 0;
                    font-family: PingFangSC-Medium;
                    background-color: #e3e4e6;
                    box-shadow: inset 0px 0px 3px 0px
                    rgba(205, 214, 219, 0.2);
                    border-radius: 20px;">
                    {{--<button><span class="glyphicon glyphicon-search"></span></button>--}}
                </form>
            </div>
        </div>
    </div>
    <div style="background:#f2f4f5">
        <div id="content" class="content row" style="padding-top:38px">
            <div class="col-md-8">
                @foreach($list as $list)
                    <div class="pull-left" style="width:400px;height: 400px;background: #ffffff;margin:0 40px 37px 0">
                        <a href="{{url('/content/'.$list->id)}}">
                            <img class="img-rounded"
                                 src="{{$list->back==1?config('app.img').$list->pic:asset($list->pic)}}"
                                 alt="{{$list->title}}" style="width: 400px;height: 250px;">
                            <div style="margin-left:25px;">
                                <div class="h4"
                                     style="font-family: PingFangSC-Medium;letter-spacing: 1px;color: #333333;">{{$list->title}}</div>
                                <div style="margin: 20px 0 0 0">{{str_limit($list->desc,100)}}</div>
                            </div>
                            <div class="row" style="margin-left:25px;line-height: 25px;color: #999999;margin:10px 0 30px 0">
                                <div class="col-md-4"><span class="glyphicon glyphicon-user"></span> 余温</div>
                                <div class="col-md-4"><span class="glyphicon glyphicon-star"></span> {{$list->cateid}}</div>
                                <div class="col-md-4"><span class="glyphicon glyphicon-time"></span> {{date('Y/m/d',$list->time)}}</div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4" style="border-radius:5px;background: #ffffff;height:400px;padding-bottom: 30px">
                <div style="margin:28px 0 10px 0" class="clearfix">
                    <div class="pull-left" style="margin-left: 30px">热门标签</div>
                    <div class="pull-right" style="margin-right: 32px"><span class="glyphicon glyphicon-bookmark" style="color: red"></span></div>
                </div>
                @foreach($tag as $tag)
                    <div class="col-md-4">
                        <div class="text-center" style="margin-top:10px;color:#2869df;width: 110px;height: 28px;line-height:28px;background-color: #e2e9f7;border-radius: 14px;">
                            {{$tag->name}}</div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-4" style="border-radius:5px;background:  #ffffff;margin-top:37px;padding-bottom: 30px">
                <div style="margin:28px 0 10px 0" class="clearfix">
                    <div class="pull-left" style="margin-left: 30px">最新文章</div>
                    <div class="pull-right" style="margin-right: 32px"><span class="glyphicon glyphicon-list-alt" style="color: red"></span></div>
                </div>
                @foreach($new_article as $vo)
                    <div class="" style="margin-left:32px;line-height:55px;height: 55px;font-size: 14px">
                        <a href="{{url('/content/'.$list->id)}}">{{$vo->title}}</a>
                    </div>
                    <div style="width: 380px; height: 1px;background-color: #dde0e2;"></div>
                @endforeach
            </div>
            <div class="center-block" style="width: 450px">{{$page}}</div>
        </div>
    </div>
</div>
</body>
<script>
    window.onload = function () {
        // alert(window.screen.availWidth)
        // alert($('#content').height())
        document.getElementById("blog").style.height = $(window).height() + 'px';
        if (window.screen.availWidth > 2200) {
            {{--document.querySelector('#blog').style.backgroundImage="{{asset('image/blog_02.jpg')}}"--}}
            document.getElementById("blog").style.backgroundImage = "url({{asset('image/blog_02.jpg')}})";
        }
    }

    function btn() {
        // $("html,body").animate({scrollTop: $("#nav").offset().top}, $(window).height());
        document.querySelector('#nav').scrollIntoView(true)
    }
</script>
</html>