<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">--}}
    <script src="{{asset('js/jquery-1.8.3.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('layui/css/layui.css') }}" />
    <script src="{{asset('layui/layui.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <link rel="stylesheet" href="{{asset('css/style.css') }}"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    @include('Smartmd::php-parse')
    <title>Document</title>
    <style>
        {{--初始化css样式--}}
        .cont body, h1, h2, h3, h4, h5, h6, hr, p, blockquote, dl, dt, dd, ul, ol, li, pre, form, fieldset, legend, button, input, textarea, th, td {
            margin: 0;
            padding: 0;
        }

        .cont body {
            margin: 0;
            padding: 29px 0 0;
            font: 14px "\5B8B\4F53", sans-serif;
            background: #ffffff;
        }

        .cont h1, h2, h3, h4, h5, h6 {
            font-size: 100%;
        }

        .cont address, cite, dfn, em, var {
            font-style: normal;
        }

        .cont code, kbd, pre, samp {
            font-family: couriernew, courier, monospace;
        }

        cont small {
            font-size: 12px;
        }

        .cont ul, ol {
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

        a:hover {
            text-decoration: none
        }
    </style>
</head>
<body>
<div>
    <div id="nav"
         style="height: 65px;background-color: #ffffff;box-shadow: 0px 6px 15px 0px rgba(10, 30, 68, 0.15);border-radius: 10px;">
        <div class="content row" style="margin-top: 15px">
            <div class="log col-md-2">
                <a href="{{url('/')}}"><img src="{{asset($info->image)}}" alt="指尖余温"></a>
            </div>
            <div class="col-md-8" >
                @foreach($colum as $vo)
                    <a href="{{url('home/'.$vo->type)}}" @if($vo->type==$type) class="active text-center"
                       @endif class="text-center hue"
                       style="float:right;width:140px;line-height:50px;height: 50px;">{{$vo->name}}</a>
                    {{--<div  class="col-md-1" style="background-color: #2869df;width: 140px;height: 50px; "><a @if($vo->type==$type) class="active"@endif href="{{url('home/'.$vo->type)}}" style="overflow: hidden;width: 140px;height: 50px; letter-spacing: 0px; color: #37424d;">{{$vo->name}}</a></div>--}}
                @endforeach
            </div>
            <div class="col-md-2">
                <form action="{{url('search')}}" method="get">
                    <div class=""  style="width: 231px;
                                        height: 40px;
                                        border: 0;
                                        font-family: PingFangSC-Medium;
                                        background-color: #e3e4e6;
                                        box-shadow: inset 0px 0px 3px 0px
                                        rgba(205, 214, 219, 0.2);
                                        border-radius: 20px;">
                        <input type="text" style=" background-color: #e3e4e6; border: 0;height:20px;margin:10px 0 10px 20px;width: 170px;" placeholder="输入关键字搜索">
                        <button style="border: 0; color: #2869df"><span class="glyphicon glyphicon-search"></span></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div style="background:#f2f4f5;padding-bottom: 100px">
        <div id="content" class="content row" style="padding-top:38px">
            <div class="col-md-8" style="background: #ffffff;padding-top: 10px">
                <div>
                    <p class="h4 col-md-6 col-md-offset-3 text-center">{{$content->title}}</p>
                    <div class="col-md-12" style="margin: 2% 0 5% 0">
                        <div class="col-lg-3 text-center"><span class="glyphicon glyphicon-user"></span>&nbsp;余温</div>
                        <div class="col-lg-6 text-center"><span
                                    class="glyphicon glyphicon-time"></span>{{date('Y年m月d日 H时i分',$content->time)}}</div>
                        <div class="col-lg-2 text-center"><span class="glyphicon glyphicon-list-alt"></span>
                            &nbsp;{{$content->cateid}}</div>
                    </div>
                </div>
                <div class="cont col-md-12">
                    <div id="content" class="markdown-body">
                    {{--{!! $html !!}--}}
                    {!! $content->back==1?str_replace('<img src="','<img src="'.config('app.img'),$content->account):$content->account !!}
                    </div>
                </div>
                {{--@if(!$article_tag->isEmpty())--}}
                    {{--<div class="col-md-12">--}}
                        {{--<p class="col-md-1 text-center">tag:</p>--}}
                        {{--@foreach($article_tag as $article_tag)--}}
                            {{--<a href="{{url('label/'.$article_tag->id)}}" class="col-md-2 text-center"--}}
                               {{--style="margin: 5px;border-radius: 10px;background: #e7e7e7;text-decoration: none;">{{$article_tag->name}}</a>--}}
                        {{--@endforeach--}}
                    {{--</div>--}}
                {{--@endif--}}
                <div class="col-md-12" style="padding:30px 0 30px 0;margin:30px 0 30px 0;border-top:1px dashed #cacbcc;border-bottom:1px dashed #cacbcc;">
                    @if($up_article)
                        <div style="color:#1e5ccb;margin-left: 20px">
                            上一篇:
                            <a style="color:#1e5ccb" href="{{url('content/'.$up_article->id)}}">{{$up_article->title}}</a>
                        </div>
                    @endif
                    @if($next_article)
                        <div style="color:#1e5ccb;margin: 20px 0 0 20px">
                            下一篇:
                            <a style="color:#1e5ccb" href="{{url('content/'.$next_article->id)}}">{{$next_article->title}}</a>
                        </div>
                    @endif
                </div>
                <div class="panel panel-default col-md-12 " id="word">
                    {{--<div class="panel-heading">--}}
                        {{--<h3 class="panel-title">--}}
                            {{--评论留言区:--}}
                        {{--</h3>--}}
                    {{--</div>--}}
                    <div id="comment-2491" class="row b-user b-parent" style="padding-top: 20px" v-for="(vo,key) in message" :key="key">
                        <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 b-pic-col">
                            <img class="b-user-pic js-head-img" :src="vo.avatar" :alt="vo.nickname"
                                 :title="vo.nickname">
                        </div>
                        <div style="margin-bottom: 10px" class="col-xs-10 col-sm-11 col-md-11 col-lg-11 b-content-col b-cc-first">
                            <div style="margin-bottom: 10px">
                                <span class="b-user-name">@{{vo.nickname}}</span>：@{{vo.content}}
                                <p class="b-date">
                                    @{{vo.time}} <a href="javascript:;" :username="vo.nickname"  v-on:click="reply(vo.id,vo.nickname,key)">回复</a>
                                </p>
                            </div>
                            <div v-for="level in vo.level">
                                <hr class="layui-bg-gray">
                                <div style="margin-top: 10px" id="comment-2532" class="row b-user b-child">
                                    <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 b-pic-col">
                                        <img class="b-user-pic js-head-img" :src="level.avatar" :alt="level.nickname" :title="level.nickname">
                                    </div>
                                    <ul class="col-xs-10 col-sm-11 col-md-11 col-lg-11 b-content-col">
                                        <li class="b-content">
                                            <span class="b-reply-name">@{{level.nickname}}</span>
                                            <span class="b-reply">回复</span>
                                            <span class="b-user-name">@{{level.father_nickname}}</span>@{{level.content}}
                                        </li>
                                        <li class="b-date">
                                            @{{level.time}} <a href="javascript:;" aid="120" pid="2532" v-on:click="reply(level.id,level.nickname,key)">回复</a>
                                        </li>
                                        <li class="b-clear-float"></li>
                                    </ul>
                                </div>
                                <div class="b-clear-float"></div>
                            </div>
                        </div>
                        <hr  class="layui-bg-gray">
                        {{--<div style=" margin-bottom:1px;width: 90%;height: 1px;background-color: #e3e5e6;"></div>--}}
                    </div>
                    <hr class="layui-bg-gray">
                    {{--{{pd(session('user_id'))}}--}}
                        {{--{{pd(session('user_id'))}}--}}
                        <div>
                            <form id="form">
                                <div class="panel-body">
                                    <div class="form-group">
                                        <label for="name" id="huifu_nickname">说点什么：</label>
                                        <textarea class="form-control" rows="3"  v-model="contents"  style="resize:none"></textarea>
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="text" class="form-control" v-model="email" name="email" id="email" placeholder="接受回复的email地址">
                                        </div>
                                    </div>
                                    {{ csrf_field() }}
                                </div>
                            </form>
                            @if(session()->has('user_id'))
                                <button class="layui-btn" v-on:click="butn()" id="btn">评论</button>
                            @else
                                 <div  class="layui-btn">请<a href="javascript:;" onclick="login()">登陆</a>后评论 </div>
                            @endif
                        </div>
                </div>
            </div>
            <div class="col-md-4" style="background: #f2f4f5;padding-bottom: 30px;">
                <div style="border-radius:5px;background: #ffffff;padding-top:2px;margin-bottom: 30px;height: 400px">
                    <div style="margin:28px 0 10px 0" class="clearfix">
                        <div class="pull-left" style="margin-left: 30px">热门标签</div>
                        <div class="pull-right" style="margin-right: 32px"><span class="glyphicon glyphicon-bookmark"
                                                                                 style="color: red"></span></div>
                    </div>
                    @foreach($tag as $tag)
                        <div class="col-md-4">
                            <div class="text-center"
                                 style="margin-top:10px;color:#2869df;width: 110px;height: 28px;line-height:28px;background-color: #e2e9f7;border-radius: 14px;">
                                <a href="{{url('label/'.$tag->id)}}" style="color:#2869df;">{{$tag->name}}</a>
                               </div>
                        </div>
                    @endforeach
                </div>
                <div>
                    <div style="border-radius:5px;background:  #ffffff;padding-top:2px;margin-top:37px;padding-bottom: 30px">
                        <div style="margin:28px 0 10px 0" class="clearfix">
                            <div class="pull-left" style="margin-left: 30px">最新文章</div>
                            <div class="pull-right" style="margin-right: 32px"><span
                                        class="glyphicon glyphicon-list-alt" style="color: red"></span></div>
                        </div>
                        @foreach($new_article as $vo)
                            <div class="" style="margin-left:32px;line-height:55px;height: 55px;font-size: 14px">
                                <a href="{{url('/content/'.$vo->id)}}">{{$vo->title}}</a>
                            </div>
                            <div style="width: 380px; height: 1px;background-color: #dde0e2;"></div>
                        @endforeach
                    </div>
                </div>


            </div>

        </div>
        <div class="content clearfix" style="background-color: #ffffff;border-radius: 10px;margin-top:30px;box-shadow: 0px 0px 15px 0px
		rgba(37, 38, 39, 0.1);">
            <div class="pull-left text-center" style="width: 12.5%;height: 100px;line-height: 100px">
                友情链接:
            </div>
            @foreach($url as $url)
                <div class="pull-left text-center" style="width: 12.5%;height: 100px;line-height: 100px">
                    <a href="{{$url->url}}" title="{{$url->title}}" target="_blank">{{$url->title}}</a>
                </div>
            @endforeach
        </div>
    </div>
    <div class="footer" style="background-color: #202428;color: #cacaca;">
        <div class="content">
            <div class="info" style="height: 132px;">
                @if($info->mobile)
                    <div class="col-md-4 clearfix ">
                        <div style="width: 150px;margin: 0 auto">
                            <div class="pull-left" style="font-size: 34px;line-height: 132px;color: #414549"><span
                                        class="glyphicon glyphicon-earphone"></span></div>
                            <div class="pull-left" style="margin-top: 47px;margin-left:20px">
                                <div style="color: #727578;">联系电话</div>
                                <div style="margin-top:5px">{{$info->mobile}}</div>
                            </div>
                        </div>
                        <div class="pull-right"
                             style="width: 3px;margin-top: 27px;height: 81px;background-color: #383f46;"></div>
                    </div>
                @endif
                @if($info->email)
                    <div class="col-md-4 clearfix ">
                        <div style="width: 200px;margin: 0 auto">
                            <div class="pull-left" style="font-size: 34px;line-height: 132px;color: #414549"><span
                                        class="glyphicon glyphicon-envelope"></span></div>
                            <div class="pull-left" style="margin-top: 47px;margin-left:20px">
                                <div style="color: #727578;">联系邮箱</div>
                                <div style="margin-top:5px">{{$info->email}}</div>
                            </div>
                        </div>
                        <div class="pull-right"
                             style="width: 3px;margin-top: 27px;height: 81px;background-color: #383f46;"></div>
                    </div>
                @endif
                @if($info->qq)
                    <div class="col-md-4 clearfix ">
                        <div style="width: 180px;margin: 0 auto">
                            <div class="pull-left" style="font-size: 34px;line-height: 132px;color: #414549"><span
                                        class="glyphicon glyphicon-user"></span></div>
                            <div class="pull-left" style="margin-top: 47px;margin-left:20px">
                                <div style="color: #727578;">社交账户</div>
                                <div style="margin-top:5px">QQ:{{$info->qq}}</div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="copyright text-center" style="height: 81px;line-height: 81px;color: #414951;">
                {{$info->bottom_info}}
            </div>
        </div>
    </div>
</div>
</body>
<script>
    var app = new Vue({
        el: '#word',
        data: {
            message: @json($word),
            type: 1,
            contents: '',
            key:-1,
            email: '',
            users_id: '',
            article_id: @json($content->id),
            userProfile: '',
            _token:'{{csrf_token()}}',
            u_id: @json($content->id),
            ceshi:[2,1,3]
        },
        created () {
        },
        methods: {
            reply:function (u_id,nickname,key) {
                this.users_id ={{session('user_id')}}+1;
                if (this.users_id == 1){
                    layer.msg('请登录后评论',{offset: '40%'})
                    return false;
                }
                this.u_id = u_id
                this.key = key
                this.type = 3
                $('#huifu_nickname').html('回复:'+ nickname)
                $("html,body").animate({scrollTop: $("#form").offset().top}, 500);//定位到《静夜思》
            },

            butn:function (){
                if (this.contents.length < 10) {
                    //弹出错误信息
                    layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.msg('多写点。。', {offset: '40%', icon: 5});
                    });

                    return false;
                }
                var pattern = /\w[-\w.+]*@([A-Za-z0-9][-A-Za-z0-9]+\.)+[A-Za-z]{2,14}/;
                if (this.email = '' && pattern.test(this.email)){
                    layui.use('layer', function(){
                        var layer = layui.layer;
                        layer.msg('邮箱地址错误。。', {offset: '40%', icon: 5});
                    });
                }
                let self = this
                $.ajax({
                    type: "POST",
                    url: "{{url('vip/comment')}}",
                    dataType: "json",
                    data: { type: this.type, contents: this.contents,article_id:this.article_id ,email: this.email, users_id: this.users_id, '_token':"{{csrf_token()}}", u_id:this.u_id},
                    success: function (msg) {
                        if (msg['status'] ==1){
                            $.post("{{url('vip/article_work')}}",{'article_id':@json($content->id),'_token':"{{csrf_token()}}"},function (data) {
                                self.message = data
                                self.email = ''
                                self.contents = ''
                            },"json");
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.msg(msg['info'],{offset: '40%'})
                            });
                        } else {
                            layui.use('layer', function(){
                                var layer = layui.layer;
                                layer.msg(msg['info'],{offset: '40%'})
                            });

                        }
                    },
                    error: function (msg) {
                        console.log(msg)
                    }
                })
            },
        },
        computed:{

        }
    })
</script>
<script>
    function login(){
        layui.use(['layer'], function(){
            var layer = layui.layer;
            data = "正在申请，请用github登录";
            layer.open({
                type: 1,
                title:'<div class="text-center" >无需注册，直接登录</div>',
                // skin: 'layui-layer-rim', //加上边框
                // offset: 't',
                area:['414px','380px'],
                offset:'233px',//距离顶部高度
                content: `<div style="border-radius:50px">
                                <div>
                                    <div style="margin-top:43px">
                                    <a href="{{url('/login/loginGithub/qq')}}"><img class="center-block" src="https://baijunyao.com/images/home/qq-login.png" alt="QQ登录" title="QQ登录"></a>
                                    </div>
                                    <div style="margin-top:36px">
                                    <a href="{{url('/login/loginGithub/weibo')}}"><img class="center-block"  src="https://baijunyao.com/images/home/sina-login.png" alt="微博登录" title="微博登录"></a>
                                    </div>
                                    <div style="margin-top:36px">
                                    <a href="{{url('/login/loginGithub/github')}}"><img class="center-block" src="https://baijunyao.com/images/home/github-login.jpg" alt="github登录" title="github登录"></a>
                                    </div>
                                </div>
                                 <div class="text-center" style="margin-top:56px">
                                 <span style="color:#e6e6e6">---------------</span> &nbsp;第三方账户登录&nbsp; <span style="color:#e6e6e6" >---------------</span>
                                </div>
                         </div>`,
            });
        });
    }
</script>
</html>