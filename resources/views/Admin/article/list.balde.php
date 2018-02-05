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
        文章列表
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
        <table>
            <tr>
                <td>文章ID</td>
                <td>文章名称</td>
                <td>文章介绍</td>
                <td>文章类型</td>
                <td>时间</td>
                <td>是否显示</td>
                <td>操作</td>
            </tr>


        </table>
    </div>
</div>
@endsection