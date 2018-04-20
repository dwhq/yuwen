@extends('public.child')

@section('title', '会员列表')
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
        <li><a href="#">会员管理</a></li>
        <li class="active">会员列表</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading h4">
            会员列表
        </div>
        <div class="panel-body layui-form">
            <!-- /resources/views/post/create.blade.php -->
            <!-- Create Post Form -->
            <div class="col-md-12">
                <table class="table table-striped table-hover table table-bordered">
                    <tr>
                        <td>会员ID</td>
                        <td>会员编号</td>
                        <td>会员昵称</td>
                        <td>会员姓名</td>
                        <td>email</td>
                        <td>QQ</td>
                        <td>mobile</td>
                        <td>会员来源</td>
                        <td>操作</td>
                    </tr>
                    @foreach($data as $vo)
                        <tr>
                            <td>{{$vo->id}}<img src="{{$vo->avatar}}" width="45" alt="{{$vo->nickname}}"></td>
                            <td>{{$vo->account or '暂无'}}</td>
                            <td>{{$vo->nickname or ''}}</td>
                            <td>{{$vo->name}}</td>
                            <td>{{$vo->meail or '暂无'}}</td>
                            <td>{{$vo->qq or '暂无'}}</td>
                            <td>{{$vo->mobile or '暂无'}}</td>
                            <td>@if($vo->type == 1)
                                    github
                                @elseif($vo->type == 2)
                                    qq
                                @elseif($vo->type == 3)
                                    weibo
                                @else
                                    其他
                                @endif
                            </td>
                            <td class="text-center">
                                {{--<a class="btn btn-primary btn-lg " href="{{url('admin/column/alter/'.$vo->id)}}">--}}
                                    {{--<span class="glyphicon glyphicon-pencil"></span>--}}
                                {{--</a>&nbsp;&nbsp;--}}
                                {{--<a class="btn btn-primary btn-lg " href="{{url('admin/column/delect/'.$vo->id)}}" onClick="return confirm('确定删除?');">--}}
                                    {{--<span class="glyphicon glyphicon-trash"></span>--}}
                                {{--</a>--}}
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
                $.post("{{url('admin/column/state')}}",{'u_id':id,'show':show,'_token':"{{csrf_token()}}"});
            }
            function sort (id,sort) {
                console.log(sort);
                $.post("{{url('admin/column/sort')}}",{'id':id,'sort':sort,'_token':"{{csrf_token()}}"});
            }
        </script>
    </div>
@endsection