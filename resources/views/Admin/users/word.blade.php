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
        <li><a href="#">留言管理</a></li>
        <li class="active">留言列表</li>
    </ol>
    <ul id="demo"></ul>
    <div class="panel panel-default">
        <div class="panel-heading h4">
            留言列表
        </div>
        <div class="panel-body">
            <div class="col-md-12">
                <table class="table table-striped table-hover table table-bordered">
                    <tr>
                        <td> ID </td>
                        <td>昵称</td>
                        <td>内容</td>
                        <td>是否显示</td>
                        <td>时间</td>
                        <td>在文章中查看</td>
                    </tr>
                    @foreach($data as $vo)
                        <tr>
                            <td>{{$vo->id}}</td>
                            <td>{{$vo->nickname}}</td>
                            <td>{{$vo->content}}</td>
                            <td>
                                <div class="show1 text-center" dd="{{$vo->id}}"  onclick="state({{$vo->id}},0)" @if($vo->state == 0) hidden @endif ><span style="font-size: 22px;color: #399bff" class=" icon ion-checkmark-circled"></span></div>
                                <div class="show1 text-center" dd="{{$vo->id}}" onclick="state({{$vo->id}},1)"  @if($vo->state == 1) hidden @endif ><span style="font-size: 22px;color: #399bff" class="  icon ion-close-circled"></span></div>
                            </td>
                            <td>{{$vo->time}}</td>
                            <td class="text-center">
                                <a class="btn btn-success btn-lg " href="{{url('admin/article/look/'.$vo->article_id)}}">
                                    <span class="icon ion-ios-eye"></span>
                                </a>
                                <a class="btn btn-primary btn-lg " href="{{url('admin/users/wordDelect/'.$vo->id)}}" onClick="return confirm('确定删除?');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
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
                $.post("{{url('admin/users/wordState')}}",{'id':id,'show':show,'_token':"{{csrf_token()}}"});
            }
        </script>
    </div>
@endsection