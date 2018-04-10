@extends('public.child')

@section('title', '指尖余温')

@section('content')
    {{--头部导航栏--}}
    @include('public.header')
    {{--内容--}}
    <div class="col-md-5 col-md-offset-2" style="padding: 10px 0 5px 0;background: white">
        <section id="cd-timeline" class="cd-container">
            @foreach($data as $data)
                <div class="cd-timeline-block">
                    <div class="cd-timeline-img cd-picture">
                        <img src="./image/cd-icon-location.svg" alt="Picture">
                    </div>
                    <div class="cd-timeline-content">
                        <h2>{{$data->title}}</h2>
                        <p>
                            {{$data->content}}
                        </p>
                        <span class="cd-date">{{$data->updated_at}}</span>
                    </div>
                </div>
            @endforeach
        </section>
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