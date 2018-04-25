@extends('public.child')

@section('title', '时间轴列表')
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
        <li class="active">添加管理员</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                添加管理员
            </h3>
        </div>
        <div class="panel-body">
            <form class="layui-form col-md-4 center-block" action="" >
                <div class="layui-form-item">
                    <label class="layui-form-label">名称:</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">密码框</label>
                    <div class="layui-input-block">
                        <input type="password" name="password" required lay-verify="required" placeholder="请输入密码" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">email:</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="form-group">
                    <label for="name" class="col-sm-2 control-label">性别:</label>
                    <div class="col-sm-10">
                        <input type="checkbox" name="state" value="1"  title="显示" checked lay-text="显示|隐藏">
                        <input type="radio" name="sex" value="nan" title="男">
                        <input type="radio" name="sex" value="nv" title="女" >
                        <input type="radio" name="sex" value="" title="不显示" checked>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">手机:</label>
                    <div class="layui-input-block">
                        <input type="text" name="title" required  lay-verify="required" placeholder="请输入标题" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection