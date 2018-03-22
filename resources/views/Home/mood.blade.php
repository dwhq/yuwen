@extends('public.child')

@section('title', '指尖余温')

@section('content')
    {{--头部导航栏--}}
    @include('public.header')
    {{--内容--}}
    <div class="col-md-5 col-md-offset-2" style="padding: 10px 0 5px 0;background: white">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">时间轴</h3>
            </div>
            <div class="panel-body">
                <div class="layui-collapse" style="padding: 10px">
                    <ul class="layui-timeline">

                        @foreach($data as $data)
                            <li class="layui-timeline-item">
                                <i class="layui-icon layui-timeline-axis">&#xe63f;</i>
                                <div class="layui-timeline-content layui-text">
                                    <h3 class="layui-timeline-title">{{$data->updated_at}}</h3>
                                   <div class="h4">{{$data->title}}</div>
                                    <p>
                                        {{$data->content}}
                                    </p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
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

    <style type="text/css">
        h2.top_title{border-bottom:none;background:none;text-align:center;line-height:32px; font-size:20px}
        h2.top_title span{font-size:12px; color:#666;font-weight:500}
    </style>
@endsection