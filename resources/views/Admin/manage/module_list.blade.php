@extends('public.child')

@section('title', '后台管理')
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
        <li><a href="#">权限管理</a></li>
        <li class="active">管理员列表</li>
    </ol>
    <div class="panel panel-default ">

        <div class="panel-heading col-md-12">
            <a href="#" onclick="popup('{{url('admin/manage/add_url/0')}}')" class="layui-btn layui-btn-normal">添加父级菜单</a>
        </div>
        <div class="panel-body col-md-12">
            <table class="layui-table" lay-even="" lay-skin="line">
                <tbody>
                @foreach($data as $vo)
                    <tr>
                        <td>
                            <ul class="list-inline row" style="margin-left: 2% ">
                                <li class="col-md-2">{{$vo->name}}&nbsp;@if($vo->status == 1)
                                        <span class="layui-bg-red">显示</span>@else<span
                                                class="layui-bg-blue">隐藏</span>@endif</li>
                                <li class="col-md-2 col-md-offset-8">
                                    <a href="#" class="layui-btn layui-btn-primary layui-btn-sm" onclick="popup('{{url('admin/manage/add_url/'.$vo->id)}}')">管理列表</a>
                                    <a href="#" class="layui-btn layui-btn-normal layui-btn-sm">编辑列表</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ul class="list-inline row" style="margin-left: 2%">
                                @foreach($vo->level as $dd)
                                    <li class="col-md-1">{{$dd->name}}&nbsp;@if($dd->status == 1)<span
                                                class="layui-bg-red">显示</span>@else<span
                                                class="layui-bg-blue">隐藏</span>@endif </li>
                                @endforeach
                            </ul>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function popup(url)
        {
            layui.use('layer', function(){
                layer.open({
                    type: 2,
                    area: ['600px', '500px'],
                    fixed: false, //不固定
                    maxmin: true,
                    content: "{{url('admin/manage/add_url/0')}}"
                });
            })
        }


    </script>
@endsection