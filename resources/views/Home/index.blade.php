@extends('public.child')

@section('title', '指尖余温')

@section('content')
    {{--头部导航栏--}}
    @include('public.header')
    {{--内容--}}
    <div class="col-md-5 col-md-offset-2" style="padding: 10px 0 5px 0">
        @if($title)
            {!! $title !!}
        @endif
        @foreach($list as $list)
        <article class="col-lg-11 table-bordered " style="margin-top: 5%;background: white">
            <div class="col-lg-12" style="margin-bottom: 10px " title="{{$list->title}}" target="_blank">
                <a href="{{url('/content/'.$list->id)}}" class="col-lg-11 h3 text-primary">{{$list->title}}</a>
                <div class="col-md-12" style="margin-bottom: 3px">
                    <div class="col-lg-3"><span class="glyphicon glyphicon-user"></span>&nbsp;余温</div>
                    <div class="col-lg-6"><span class="glyphicon glyphicon-time"></span>{{date('Y年m月d日 H时i分',$list->time)}}</div>
                    <div class="col-lg-2"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;{{$list->cateid}}</div>
                </div>
                <div style="height: 100px">
                    <img class="col-md-4 img-thumbnail aft"
                         src="{{$list->back==1?config('app.img').$list->pic:asset($list->pic)}}" alt="{{$list->title}}" class="thumb"
                         style="display: inline; height: 100px">
                </div>
                <div class="col-md-6" style="margin-top: 3%">
                    <p>
                        {{str_limit($list->desc,100)}}
                    </p>
                </div>
                <a href="{{url('/content/'.$list->id)}}" class="text-center col-md-2 col-md-offset-9 btn btn-primary" style="color: white;">查看原文</a>
            </div>

        </article>
        @endforeach
            <div class="row">
                {{ $page}}
            </div>
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