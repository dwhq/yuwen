@extends('public.child')

@section('title', '指尖余温')

@section('content')
    {{--头部导航栏--}}
    @include('public.header')
    {{--内容--}}
    <div class="col-md-5 col-md-offset-2" style="padding: 37px 0 5px 0">
        @if($title)
            {!! $title !!}
        @endif
        @foreach($list as $list)
        <article class="col-lg-11 table-bordered " style="padding-top: 10px;margin-top:15px;background: white">
            <div class="col-lg-12" style="padding-bottom: 15px " title="{{$list->title}}" target="_blank">
                <div class="col-md-12" style="">
                    <a href="{{url('/content/'.$list->id)}}" class="col-md-12 h3 text-primary">{{$list->title}}</a>
                </div>
                <div class="col-md-12" >
                    <div class="col-md-4"><span class="glyphicon glyphicon-user"></span>余温</div>
                    <div class="col-md-5"><span class="glyphicon glyphicon-time"></span>{{date('Y年m月d日 H时i分',$list->time)}}</div>
                    <div class="col-md-3"><span class="glyphicon glyphicon-list-alt"></span> &nbsp;{{$list->cateid}}</div>
                </div>
                <div class="col-md-12" style="padding-top: 15px;position: relative;">
                    <div style="height: 100px" class="col-md-4">
                        <img class=" img-thumbnail aft"
                             src="{{$list->back==1?config('app.img').$list->pic:asset($list->pic)}}" alt="{{$list->title}}" class="thumb"
                             style="display: inline; height: 100px">
                    </div>
                    <div class="col-md-5" style="margin-top: 3%">
                        <p>
                            {{str_limit($list->desc,100)}}
                        </p>
                    </div>
                    <a href="{{url('/content/'.$list->id)}}" class="text-center col-md-3  btn btn-primary" style="color: white;position: absolute; bottom: 0;">查看原文</a>
                </div>
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