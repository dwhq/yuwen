@extends('public.child')

@section('title', '指尖余温')

@section('content')
    {{--头部导航栏--}}
    @include('public.header')
    {{--内容--}}
    <div class="col-md-5 col-md-offset-2" style="padding: 10px 0 5px 0">
        内容
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