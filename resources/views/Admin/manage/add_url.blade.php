@extends('public.child')

@section('title', '添加模板')
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
        <li class="active">添加模板</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                添加模板
            </h3>
        </div>
        <div class="panel-body">
            <form class="layui-form col-md-4 center-block" action="{{url('admin/manage/add_url/'.$id)}}"  method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">名称:</label>
                    <div class="layui-input-block">
                        {{--pattern="[\u4e00-\u9fa5]{2,}" 验证表单的正则表单   required 表单不能为空--}}
                        <input type="name" name="name" id="name" required   lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-plus" onclick="iocn('glyphicon glyphicon-plus')"></span>
                    <span class="glyphicon glyphicon-minus" onclick="iocn('glyphicon glyphicon-minus')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                    <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图标:</label>
                    <div class="layui-input-block">
                        <input type="name" name="name" id="name" required   lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">路由地址</label>
                    <div class="layui-input-block">
                        {{--pattern="[\u4e00-\u9fa5]{2,}" 验证表单的正则表单   required 表单不能为空--}}
                        <input type="name" name="url" id="url" required @if($id == 0)readonly="true" value="#"@endif lay-verify="required" placeholder="请输地址" autocomplete="off" class="layui-input">
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label class="layui-form-label">是否显示:</label>
                    <div class="layui-input-block">
                        <input type="checkbox" class="checkbox" value="1" name="status" title="显示">
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
    </script>
@endsection