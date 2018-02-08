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
        {{--<div class="panel panel-default col-md-12">--}}
            {{--<div class="panel-heading">--}}
                {{--<h3 class="panel-title">--}}
                    {{--评论留言区:--}}
                {{--</h3>--}}
            {{--</div>--}}
            {{--<div class="panel-body">--}}
                {{--<div class="form-group">--}}
                    {{--<label for="name">说点什么：</label>--}}
                    {{--<textarea class="form-control " style="resize: none;" rows="3" ></textarea>--}}
                    {{--<div class="input-group">--}}
                        {{--<span class="input-group-addon">@</span>--}}
                        {{--<input type="text" class="form-control" name="email" id="email" placeholder="接受回复的email地址">--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<button class="btn btn-success pull-right" id="but">评论</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
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