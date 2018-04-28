@extends('public.child')

@section('title', '添加角色')
<style>
    td {
        padding: 5% 0 0 20px;
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
        <li class="active">添加角色</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                添加角色
            </h3>
        </div>
        <div class="panel-body">
            <form class="form-inline row " action="{{url('admin/manage/revamped_auth_group/'.$info->id)}}"
                  method="post">
                <div class=" col-md-6" style="margin-bottom: 10px">
                    <div class="form-group">
                        <label for="exampleInputName2">名称：</label>
                        <input type="text" class="form-control" id="title" value="{{$info->title}}" name="title" required placeholder="请输入名称">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName2"> 描述：</label>
                        <input type="text" class="form-control" id="remark" value="{{$info->remark}}" name="remark" required placeholder="请输入描述">
                    </div>
                    <div class="clo-md-1 form-group">
                        <input type="checkbox" id="check" onclick="choosebox(this)" title="全选">全选
                    </div>
                </div>
                {{ csrf_field() }}
                <button type="submit" id="btn" class="layui-btn layui-btn-normal col-md-1  col-md-offset-5">&nbsp;确&nbsp;
                    认&nbsp;
                </button>
                <table class="layui-table" lay-even="" lay-skin="line">
                    <tbody>
                    @foreach($data as $vo)
                        <tr>
                            <td>
                                <ul class="list-inline row" style="margin-left: 2% ">
                                    <li class="col-md-2" dd="{{$vo->id}}"><span
                                                class="{{$vo->icon}}"></span>&nbsp;{{$vo->name}} &nbsp;
                                        <input type="checkbox" onclick="checks(this)" name="rulers[{{$vo->id}}]" @if(in_array($vo->id,$info->rulers))checked @endif value="{{$vo->id}}" title="全选">全选下级
                                    </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <ul class="list-inline row" style="margin-left: 2%">
                                    @foreach($vo->level as $dd)
                                        <li class="col-md-2 checkbox" dd="{{$dd->id}}"><span
                                                    class="{{$dd->icon}}"></span>&nbsp;{{$dd->name}} &nbsp;
                                            <input type="checkbox" value="{{$dd->id}}" @if(in_array($vo->id,$info->rulers))checked @endif onclick="checksup(this)" name="rulers[{{$dd->id}}]">
                                        </li>
                                    @endforeach
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </form>
        </div>
    </div>
    <script>
        //只有执行了这一步，部分表单元素才会自动修饰成功
        layui.use('form', function () {
            //var form = layui.form;

            //form.render();
        });
        $('#btn').click(function () {
            var checked = $("input[type=checkbox]").is(':checked');
            if (!checked) {
                layui.use('layer', function () {
                    var layer = layui.layer;
                    layer.msg('至少选一个用户组', {offset: '40%', icon: 5});
                });
                return false;
            }
            if ($('#title').val() == '') {
                layui.use('layer', function () {
                    var layer = layui.layer;
                    layer.msg('名称不能为空', {offset: '40%', icon: 5});
                });
                return false;
            }
        })
        function choosebox(o){
            var vt = $(o).is(':checked');
            //选择所有$('input[type=checkbox]') 下的checkbox 为勾选状态
            if(vt){
                $('input[type=checkbox]').prop('checked',vt);
            }else{
                $('input[type=checkbox]').removeAttr('checked');
            }
        }
        function checks(o){
            var vt = $(o).is(':checked');
            if(vt){
                //选择本元素上级trparents('tr')的同一级的下一个 trnext('tr') 的下面的所有find('input[type=checkbox]')元素 设置全部勾选状态
                $(o).parents('tr').next('tr').find('input[type=checkbox]').prop('checked',vt);
            }else{
                $(o).parents('tr').next('tr').find('input[type=checkbox]').removeAttr('checked');
            }
        }
        function checksup(o){
            var vt = $(o).is(':checked');
            $(o).parents('tr').prev('tr').find('input[type=checkbox]').prop('checked',vt);
        }
    </script>
@endsection