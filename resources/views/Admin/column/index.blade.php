@extends('public.child')

@section('title', '栏目列表')
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
        <li><a href="#">栏目管理</a></li>
        <li class="active">栏目列表</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading h4">
            文章列表
        </div>
        <div class="panel-body">
            <!-- /resources/views/post/create.blade.php -->
        <!-- Create Post Form -->
            <div class="col-md-12">
                <table class="table table-striped table-hover table table-bordered">
                    <tr>
                        <td>栏目ID</td>
                        <td>栏目名称</td>
                        <td>是否显示</td>
                        <td>栏目类型</td>
                        <td>排序</td>
                        <td>操作</td>
                    </tr>
                    @foreach($list as $vo)
                        <tr>
                            <td>{{$vo->id}}</td>
                            <td>{{$vo->name}}</td>
                            <td>
                                <div class="show1 text-center" dd="{{$vo->id}}"  onclick="state({{$vo->id}},0)" @if($vo->state == 0) hidden @endif ><span style="font-size: 22px;color: #399bff" class=" icon ion-checkmark-circled"></span></div>
                                <div class="show1 text-center" dd="{{$vo->id}}" onclick="state({{$vo->id}},1)"  @if($vo->state == 1) hidden @endif ><span style="font-size: 22px;color: #399bff" class="  icon ion-close-circled"></span></div>
                            </td>
                            <td>{{$vo->type}}</td>
                            <td>
                                <input type="text" name="sort" value="{{$vo->sort}}" onchange="sort({{$vo->id}},$(this).val())" style="width: 50px;border-left:0px;border-top:0px;border-right:0px;border-bottom:1px">
                            </td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-lg " href="{{url('admin/column/alter/'.$vo->id)}}">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>&nbsp;&nbsp;
                                <a class="btn btn-primary btn-lg " href="{{url('admin/column/delect/'.$vo->id)}}" onClick="return confirm('确定删除?');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="pull-right">
                    {{$list->links()}}
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