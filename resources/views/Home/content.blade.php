@extends('public.child')

@section('title', '指尖余温')

@section('content')
    {{--头部导航栏--}}
    @include('public.header')
    {{--内容--}}
    <div class="col-md-5 col-md-offset-2" style="padding: 10px 0 5px 0;background: white">
        <div>
            <p class="h4 col-md-6 col-md-offset-3 text-center">{{$content->title}}</p>
            <div class="col-md-12" style="margin: 2% 0 5% 0">
                <div class="col-lg-3 text-center"><span class="glyphicon glyphicon-user"></span>&nbsp;余温</div>
                <div class="col-lg-6 text-center"><span class="glyphicon glyphicon-time"></span>{{date('Y年m月d日 H时i分',$content->time)}}</div>
                <div class="col-lg-2 text-center"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;{{$content->cateid}}</div>
            </div>
        </div>
        <div class="col-md-12">
            {!! $content->back==1?str_replace('<img src="','<img src="'.config('app.img'),$content->account):$content->account !!}
        </div>
        @if(!$article_tag->isEmpty())
            <div class="col-md-12">
                <p class="col-md-1 text-center">tag:</p>
                @foreach($article_tag as $article_tag)
                    <a href="{{url('label/'.$article_tag->id)}}" class="col-md-2 text-center" style="margin: 5px;border-radius: 10px;background: #e7e7e7;text-decoration: none;">{{$article_tag->name}}</a>
                @endforeach
            </div>
        @endif
        <div class="col-md-12" style="padding-bottom: 10px">
            @if($up_article)
                <div class="col-md-12">
                    <div  class="col-md-2">上一篇 : </div>
                    <a href="{{url('content/'.$up_article->id)}}">{{$up_article->title}}</a>
                </div>
            @endif
            @if($next_article)
                <div class="col-md-12">
                    <div  class="col-md-2 ">下一篇 : </div>
                    <a href="{{url('content/'.$next_article->id)}}">{{$next_article->title}}</a>
                </div>
            @endif
        </div>
        <div class="panel panel-default col-md-12">
            <div class="panel-heading">
                <h3 class="panel-title">
                    评论留言区:
                </h3>
            </div>
            @foreach($word as $vo)
                <div id="comment-2491" class="row b-user b-parent">
                    <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 b-pic-col">
                        <img class="b-user-pic js-head-img" src="{{$vo->avatar}}"  alt="{{$vo->nickname}}" title="{{$vo->nickname}}">
                    </div>
                    <div class="col-xs-10 col-sm-11 col-md-11 col-lg-11 b-content-col b-cc-first">
                        <p class="b-content">
                            <span class="b-user-name">{{$vo->nickname}}</span>：{!! $vo->content !!}
                        </p>
                        <p class="b-date">
                            {{$vo->time}} <a href="javascript:;" username="孤城浪子" onclick="reply(this)">回复</a>
                        </p>
                        <foreach name="v['child']" item="n">
                            <div id="comment-2532" class="row b-user b-child">
                                <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 b-pic-col">
                                    <img class="b-user-pic js-head-img" src="https://baijunyao.com/uploads/avatar/1.jpg" _src="https://baijunyao.com/uploads/avatar/1.jpg" alt="白俊遥博客" title="白俊遥博客">
                                </div>
                                <ul class="col-xs-10 col-sm-11 col-md-11 col-lg-11 b-content-col">
                                    <li class="b-content">
                                        <span class="b-reply-name">云淡风晴</span>
                                        <span class="b-reply">回复</span>
                                        <span class="b-user-name">孤城浪子</span>：免费拿去就是；
                                    </li>
                                    <li class="b-date">
                                        2017-09-09 00:39:01 <a href="javascript:;" aid="120" pid="2532" username="孤城浪子" onclick="reply(this)">回复</a>
                                    </li>
                                    <li class="b-clear-float"></li>
                                </ul>
                            </div>
                            <div class="b-clear-float"></div>
                        </foreach></div>
                </div>
                <hr class="layui-bg-gray">
            @endforeach
            <form id="form" >
                <div class="panel-body">
                    <div class="form-group">
                        <label for="name">说点什么：</label>
                            <textarea class="layui-textarea" name="contents" id="demo" style="display: none"></textarea>
                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" name="email" id="email" placeholder="接受回复的email地址">
                        </div>
                    </div>
                    <input type="hidden" name="type" value="1">
                    <input type="hidden" name="u_id" value="{{$content->id}}">
                    <input type="hidden" name="word_id" id="word_id" value="">
                    {{ csrf_field() }}
                </div>
            </form>
            <button class="layui-btn"  id="btn">评论</button>
        </div>
    </div>
    <script>

        layui.use(['form','layedit','layer'], function(){
            var layedit = layui.layedit;
            $ = layui.jquery;
            var index =layedit.build('demo',
                {
                    tool: ['face','left', 'center', 'right']
                    ,height: 200
                }); //建立编辑器

            $('#btn').click(function () {
                layedit.sync(index);//将编辑器的内容赋值给表单

                if ($('#demo').val().length < 10){
                    layer.msg('多写点。。', {offset: '40%',icon: 5});
                    return false;
                }
                $.ajax({
                    type:"POST",
                    url:"{{url('vip/comment')}}",
                    dataType:"json",
                    data: $('#form').serialize(),
                    success:function (msg) {

                    },
                    error:function (msg) {
                        console.log(msg)
                    }
                })
            })
        });
    </script>
    {{--右侧栏--}}
    <div class="col-md-3 clearfix " style="">
        <div style="width:90%;background: rgba(246,246,246,1);">
            @include('public.right')
        </div>
    </div>
    {{--底部网站信息--}}
    <div class="col-md-6 col-md-offset-3">
        @include('public.bottom_info')
    </div>
@endsection