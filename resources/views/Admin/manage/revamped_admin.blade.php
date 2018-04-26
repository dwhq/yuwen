@extends('public.child')

@section('title', '修改管理员')
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
        <li class="active">修改管理员</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                修改管理员{{$admin_info->name}}的信息
            </h3>
        </div>
        <div class="panel-body">
            <form class="layui-form col-md-4 center-block" action="{{url('admin/manage/revamped_admin/'.$admin_info->id)}}"  method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">名称:</label>
                    <div class="layui-input-block">
                        {{--pattern="[\u4e00-\u9fa5]{2,}" 验证表单的正则表单   required 表单不能为空--}}
                        <input type="name" name="name" id="title" required   lay-verify="required" value="{{$admin_info->name}}" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label class="layui-form-label">密码框</label>
                    <div class="layui-input-block">
                        <input type="password" name="password" id="password"  lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">email:</label>
                    <div class="layui-input-block">
                        <input type="email" name="email" id="email" required  lay-verify="required" value="{{$admin_info->email}}" placeholder="请输入email" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">性别:</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="1" title="男" @if($admin_info->sex == 1)checked @endif>
                        <input type="radio" name="sex" value="2" title="女" @if($admin_info->sex == 2)checked @endif>
                        <input type="radio" name="sex" value="0" title="不显示"@if($admin_info->sex == 0)checked @endif>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">用户组可多选:</label>
                    <div class="layui-input-block">
                        @foreach($auth_group_list as $vo)
                            <input type="checkbox" class="checkbox" name="grout[{{$vo->id}}]" @if(in_array($vo->id,$admin_info->grout))checked @endif value="{{$vo->id}}" title="{{$vo->title}}">
                        @endforeach
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机:</label>
                    <div class="layui-input-block">
                        <input type="text" name="mobile"  lay-verify="required" placeholder="请输入手机号码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <button id="btn" class="layui-btn layui-btn-normal layui-btn-fluid">提 交</button>
            </form>
        </div>
    </div>
    <script>
        //只有执行了这一步，部分表单元素才会自动修饰成功
        layui.use('form', function(){
            //var form = layui.form;

            //form.render();
        });
        $('#btn').click(function () {
            var checked=$(".checkbox:checked");
            if(checked.length == 0){
                layui.use('layer', function(){
                    var layer = layui.layer;
                    layer.msg('至少选一个用户组', {offset: '40%', icon: 5});
                });
                return false;
            }

        })
    </script>
@endsection