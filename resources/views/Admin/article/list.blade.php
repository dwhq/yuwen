@extends('public.child')

@section('title', '文章列表')
<style>
    td {
        padding: 5% 0 0 20px;
    }
    .form-group {
        padding-top: 10%;
    }
</style>
@section('import')
<!--引入CSS-->
<link rel="stylesheet" type="text/css" href="{{asset('webuploader/webuploader.css')}}">
<!--引入JS-->
<script type="text/javascript" src="{{asset('webuploader/webuploader.nolog.js')}}"></script>
@endsection
@section('content')
<ol class="breadcrumb">
    <li><a href="#">后台管理</a></li>
    <li><a href="#">文章管理</a></li>
    <li class="active">文章列表</li>
</ol>

<div class="panel panel-default">

    <div class="panel-heading h4">
        <form class="form-horizonta" action="{{url('admin/article/list')}}" method="post">
            <div class="col-md-2">
                {{ csrf_field() }}
                <input type="text" class="form-control" name="seek"  placeholder="搜索">
            </div>
            <div>
                <button type="submit" class="btn btn-primary">搜索</button>
            </div>
        </form>
    </div>
    <div class="panel-body">
        <!-- /resources/views/post/create.blade.php -->
        @if ($errors->any())
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    错误信息
                </h3>
            </div>
            <div class="panel-body">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @endif
        <!-- Create Post Form -->
        <div class="col-md-12">
            <table class="table table-striped table-hover table table-bordered">
                <tr>
                    <td>文章ID</td>
                    <td>文章名称</td>
                    <td>文章介绍</td>
                    <td>是否显示</td>
                    <td>文章类型</td>
                    <td>时间</td>
                    <td>操作</td>
                </tr>
                @foreach($list as $vo)
                    <tr>
                        <td>{{$vo->id}}</td>
                        <td>{{$vo->title}}</td>
                        <td>{{str_limit($vo->desc,50)}}</td>
                        <td>
                            <div class="show1 text-center" dd="{{$vo->id}}"  onclick="state({{$vo->id}},0)" @if($vo->state == 0) hidden @endif ><span style="font-size: 22px;color: #399bff" class=" icon ion-checkmark-circled"></span></div>
                            <div class="show1 text-center" dd="{{$vo->id}}" onclick="state({{$vo->id}},1)"  @if($vo->state == 1) hidden @endif ><span style="font-size: 22px;color: #399bff" class="  icon ion-close-circled"></span></div>
                        </td>
                        <td>{{$vo->cateid}}</td>
                        <td>{{date('Y年m月d日 H:i:s',$vo->time)}}</td>
                        <td class="text-center">
                            <a class="btn btn-primary btn-lg" href="{{url('admin/article/look/'.$vo->id)}}">
                                <span class="icon ion-ios-eye"></span>
                            </a>&nbsp;&nbsp;
                            <a class="btn btn-primary btn-lg " href="{{url('admin/article/alter/'.$vo->id)}}">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </a>&nbsp;&nbsp;
                            <a class="btn btn-primary btn-lg " href="{{url('admin/article/delect/'.$vo->id)}}" onClick="return confirm('确定删除?');">
                                <span class="glyphicon glyphicon-trash"></span>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>
            <div class="pull-right">
                {{$list->links()}}
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function state( id,show) {
            $(' [dd= '+ id+ ' ]').toggle();
            $.post("{{url('admin/article/state')}}",{'u_id':id,'show':show,'_token':"{{csrf_token()}}"});
        }
    </script>
</div>
@endsection