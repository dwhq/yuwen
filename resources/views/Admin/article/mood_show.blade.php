@extends('public.child')

@section('title', '时间轴')
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
    @include('UEditor::head')
@endsection
@section('content')

    <ol class="breadcrumb">
        <li><a href="#">后台管理</a></li>
        <li><a href="#">文章管理</a></li>
        <li class="active">添加文章</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading h4">
            添加文章
        </div>

        <div class="panel-body">
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
            <form class="col-md-12 layui-form"  enctype="multipart/form-data" method="post" id="form" class="center-block " style=" margin: 0 auto;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">标题</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title" placeholder="标题" value="">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">是否显示:</label>
                        <div class="col-sm-10">
                            <input type="checkbox" name="state" value="1"  title="写作" checked lay-text="开启|关闭>
                        </div>
                    </div>
                </div>
                <!-- 加载编辑器的容器 -->
                <div class="panel panel-default col-md-9">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            内容:
                        </h4>
                    </div>
                    <div class="panel-body">
                        <textarea class="layui-textarea" name="contents" id="demo" style="display: none"></textarea>
                    </div>
                </div>
                <!-- 实例化编辑器 -->
                <div class="col-md-4" style="padding-top: 10px">
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                </div>
            </form>
        </div>
    </div>
    <script type="text/javascript">
        //Demo
        layui.use(['form','layedit'], function(){
            var form = layui.form,
                $ = layui.jquery,
                layedit = layui.layedit
            //监听提交
            var index = layedit.build('demo',{
                tool: ['face', 'link', 'unlink', '|', 'left', 'center', 'right']
                ,height: 200
            }); //建立编辑器 一定要吧编辑器赋值给index下面要用的
            form.on('submit(formDemo)', function(data){
                layedit.sync(index);//将编辑器的内容赋值给表单
                $.post("{{url('admin/article/mood_add')}}",$('#form').serialize(),
                    function(data){
                        console.log(data)
                        if(data.status == 1){
                            layer.msg(data.info);
                            location.href = data.url
                        }else {
                            //弹出错误信息
                            layer.msg(data.info);
                        }
                        console.log(data);
                    }, "json");
                return false;
            });
        });
    </script>
@endsection