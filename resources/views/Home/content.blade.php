@extends('public.child')

@section('title', '指尖余温')
@section('import')
    <!-- 开发环境版本，包含了用帮助的命令行警告 -->
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <!-- 生产环境版本，优化了尺寸和速度 -->
    {{--<script src="https://cdn.jsdelivr.net/npm/vue"></script>--}}
@endsection
@section('content')
    {{--头部导航栏--}}
    @include('public.header')
    {{--内容--}}
    <div class="col-md-5 col-md-offset-2" style="padding: 10px 0 5px 0;background: white">
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
        <div class="col-md-12">
            {{--{!! $content->account !!}--}}
            {!! $content->back==1?str_replace('<img src="','<img src="'.config('app.img'),$content->accounts):$content->accounts !!}
        </div>
        @if(!$article_tag->isEmpty())
            <div class="col-md-12">
                <p class="col-md-1 text-center">tag:</p>
                @foreach($article_tag as $article_tag)
                    <a href="{{url('label/'.$article_tag->id)}}" class="col-md-2 text-center"
                       style="margin: 5px;border-radius: 10px;background: #e7e7e7;text-decoration: none;">{{$article_tag->name}}</a>
                @endforeach
            </div>
        @endif
        <div class="col-md-12" style="padding-bottom: 10px">
            @if($up_article)
                <div class="col-md-12">
                    <div class="col-md-2">上一篇 :</div>
                    <a href="{{url('content/'.$up_article->id)}}">{{$up_article->title}}</a>
                </div>
            @endif
            @if($next_article)
                <div class="col-md-12">
                    <div class="col-md-2 ">下一篇 :</div>
                    <a href="{{url('content/'.$next_article->id)}}">{{$next_article->title}}</a>
                </div>
            @endif
        </div>
        <div class="panel panel-default col-md-12 " id="word">
            <div class="panel-heading">
                <h3 class="panel-title">
                    评论留言区:
                </h3>
            </div>
                <div id="comment-2491" class="row b-user b-parent" v-for="(vo,key) in message" :key="key">
                    <div class="col-xs-2 col-sm-1 col-md-1 col-lg-1 b-pic-col">
                        <img class="b-user-pic js-head-img" :src="vo.avatar" :alt="vo.nickname"
                             :title="vo.nickname">
                    </div>
                    <div class="col-xs-10 col-sm-11 col-md-11 col-lg-11 b-content-col b-cc-first">
                        <div>
                            <span class="b-user-name">@{{vo.nickname}}</span>：@{{vo.content}}
                            <p class="b-date">
                                @{{vo.time}} <a href="javascript:;" :username="vo.nickname"  v-on:click="reply(vo.id,vo.nickname,key)">回复</a>
                            </p>
                        </div>
                            <div v-for="level in vo.level">
                                <hr class="layui-bg-gray">
                                    <div id="comment-2532" class="row b-user b-child">
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
                    <hr class="layui-bg-gray">
                </div>
                <hr class="layui-bg-gray">
            @if(session('user_id'))
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
                    <button class="layui-btn" v-on:click="butn()" id="btn">评论</button>

                </div>
            @else
                <div>请<a href="javascript:;" onclick="login()">登陆</a>后评论</div>
            @endif
        </div>
        {{--<div class="col-md-12">--}}
            {{--<script type="text/javascript">var jd_union_unid="1000587754",jd_ad_ids="507:6",jd_union_pid="CLayt42uLBDqg4/dAxoAINah89cEKgA=";var jd_width=728;var jd_height=90;var jd_union_euid="";var p="AhEDXBpTEQcXD2VEH0hfIlgRRgYlXVZaCCsfSlpMWGVEH0hfIllRHVhySxt4NVs5ankbYQlOC29xV2dZF2sVARcOVRleFAcXN1UaWhQGGwFTH14lMk1DCEZrXmwTNwpfBkgyEgNWHlgUBxUOXR1bHTITN2Ur";</script><script type="text/javascript" charset="utf-8" src="//u-x.jd.com/static/js/auto.js"></script>--}}
        {{--</div>--}}
    </div>
    <script>
    </script>
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