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
            <div class="col-md-4">
                {{--搜索框--}}
                <form action="{{url('admin/manage/admin_list')}}" method="post">
                    <div class="input-group">
                        <input type="text" name="name" class="form-control" value="{{$name}}" placeholder="请输入管理员姓名">
                        {{ csrf_field() }}
                        <div class="input-group-btn">
                            <input type="submit"  class="btn btn-default dropdown-toggle"  value="搜索">
                        </div><!-- /btn-group -->
                    </div><!-- /input-group -->
                </form>
            </div>
            <div class="col-md-1 col-md-offset-7">
                <a href="{{url('admin/manage/add_admin')}}" class="layui-btn layui-btn-normal">添加管理员</a>
            </div>
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
                        <td> ID </td>
                        <td>名称</td>
                        <td>sex</td>
                        <td>email</td>
                        <td>mobile</td>
                        <td>创建时间</td>
                        <td>操作</td>
                    </tr>
                    @foreach($data as $vo)
                        <tr>
                            <td>{{$vo->id}}</td>
                            <td>{{$vo->name}}</td>
                            <td>
                                @if($vo->sex = 0)
                                    隐藏
                                @elseif($vo->sex = 1)
                                    男
                                @else
                                    女
                                @endif
                            </td>
                            <td>{{$vo->email or '暂无'}}</td>
                            <td>{{$vo->mobile or '暂无'}}</td>
                            <td>{{date('Y-m-d H时i分',$vo->time) }}</td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-lg " href="{{url('admin/manage/revamped_admin/'.$vo->id)}}">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </a>
                                @if($vo->id != 1)
                                <a class="btn btn-primary btn-lg " href="{{url('admin/manage/delect/'.$vo->id)}}" onClick="return confirm('确定删除?');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pull-right">
                    {{$data->links()}}
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function state( id,show) {
                $(' [dd= '+ id+ ' ]').toggle();
                $.post("{{url('admin/article/mood_state')}}",{'u_id':id,'show':show,'_token':"{{csrf_token()}}"});
            }
        </script>
    </div>
@endsection