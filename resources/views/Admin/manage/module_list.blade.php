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
            <a href="#" onclick="popup('{{url('admin/manage/add_url/0')}}')"
               class="layui-btn layui-btn-normal">添加父级菜单</a>
        </div>
        <div class="panel-body col-md-12">
            <table class="layui-table" lay-even="" lay-skin="line">
                <tbody>
                @foreach($data as $vo)
                    <tr>
                        <td>
                            <ul class="list-inline row" style="margin-left: 2% ">
                                <li class="col-md-2" dd="{{$vo->id}}"><span
                                            class="{{$vo->icon}}"></span>&nbsp;{{$vo->name}}
                                    &nbsp;@if($vo->status == 1) <span
                                            class="layui-bg-red" onclick="show_url({{$vo->id}},0)">显示</span> @else <span
                                            class="layui-bg-blue" onclick="show_url({{$vo->id}},1)">隐藏</span> @endif
                                    <a href=" #" onclick="delete_url({{$vo->id}})">删除</a>
                                </li>
                                <li class="col-md-2 col-md-offset-8">
                                    <a href="#" class="layui-btn layui-btn-primary layui-btn-sm"
                                       onclick="popup('{{url('admin/manage/add_url/'.$vo->id)}}')">添加子类</a>
                                    <a href="#" onclick="popup('{{url('admin/manage/alter_url/'.$vo->id)}}')"
                                       class="layui-btn layui-btn-normal layui-btn-sm">编辑列表</a>
                                </li>
                            </ul>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <ul class="list-inline row" style="margin-left: 2%">
                                @foreach($vo->level as $dd)
                                    <li class="col-md-2" dd="{{$dd->id}}"><span
                                                class="{{$dd->icon}}"></span>&nbsp;{{$dd->name}}
                                        &nbsp;@if($dd->status == 1)<span
                                                class="layui-bg-red" onclick="show_url({{$dd->id}},0)">显示</span>@else
                                            <span
                                                    class="layui-bg-blue"
                                                    onclick="show_url({{$dd->id}},1)">隐藏</span>@endif
                                        <a href="#" onclick="popup('{{url('admin/manage/alter_url/'.$dd->id)}}')")><span>修改</span></a>
                                        <a href=" #" onclick="delete_url({{$dd->id}})">删除</a>
                                    </li>
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
        function popup(url) {
            layui.use('layer', function () {
                layer.open({
                    type: 2,
                    area: ['600px', '800px'],
                    fixed: false, //不固定
                    maxmin: true,
                    content: url
                });
            })
        }

        function show_url(id, state) {
            $.post("{{url('admin/manage/show_url')}}", {
                'id': id,
                'status': state,
                '_token': "{{csrf_token()}}"
            }, function (res) {
                console.log(res);
                if (res.state == 1) {
                    layui.use('layer', function () {
                        layer.msg(res.info);
                        if (state == 1) {
                            //选择属性dd等于id的元素下面的第1个 <span></span>标签 (从0开始计算)
                            $("[dd = " + id + "]").find('span:eq(1)').text('显示').attr({
                                class: 'layui-bg-red',
                                onclick: 'show_url(' + id + ',0)'
                            });
                        } else {
                            $("[dd = " + id + "]").find('span:eq(1)').text('隐藏').attr({
                                class: 'layui-bg-blue',
                                onclick: 'show_url(' + id + ',1)'
                            });
                        }
                    })
                } else {
                    layui.use('layer', function () {
                        layer.msg(res.info, {icon: 5});
                    })
                }
            });
        }

        function delete_url(id) {
            $.post("{{url('admin/manage/delete_url')}}", {'id': id, '_token': "{{csrf_token()}}"}, function (res) {
                if (res.state == 1) {
                    layui.use('layer', function () {
                        layer.msg(res.info);
                        $("[dd = " + id + "]").remove();
                    })
                } else {
                    layui.use('layer', function () {
                        layer.msg(res.info, {icon: 5});
                    })
                }
            });
        }
    </script>
@endsection