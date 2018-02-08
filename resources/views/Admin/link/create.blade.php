@extends('public.child')

@section('title', '添加文章')
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
    @include('UEditor::head');
@endsection
@section('content')

    <ol class="breadcrumb">
        <li><a href="#">后台管理</a></li>
        <li><a href="#">栏目管理</a></li>
        <li class="active">添加链接</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading h4">
            添加链接
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
            <form class="col-md-12" action="{{url('admin/link/store')}}" enctype="multipart/form-data" method="post" id="form" class="center-block " style=" margin: 0 auto;">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">链接名称</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="title" id="title" placeholder="链接名称" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">链接地址</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="url" id="url" placeholder="链接地址" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">链接描述</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="remark" id="remark" placeholder="链接描述" value="">
                        </div>
                    </div>
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">排序</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="sort" id="type" placeholder="栏目排序" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">是否显示:</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="state" id="state" value="1" checked> 显示
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="state" id="state"  value="0"> 不显示
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="col-md-4" style="padding-top: 10px">
                        <button class="btn btn-success  btn-block" style="display: block;">确认提交</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection