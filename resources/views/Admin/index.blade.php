@extends('public.child')

@section('title', '网站后台')

@section('content')
    <div class="col-md-12" style="background: #399bff;color: white;padding-bottom: 5px">
        <div class="col-md-2 h3">
            管理后台
        </div>
        <div class="col-md-3 col-md-offset-7" style="padding-top: 9px">
            <a class="col-md-4 h4">网站前台</a>
            <a class="col-md-4 h4">更新缓存</a>
            <a class="col-md-4 h4">退出登陆</a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div class="panel-group table-responsive" role="tablist">
                <div class="panel panel-primary leftMenu">
                    <!-- 利用data-target指定要折叠的分组列表 -->
                    <div class="panel-heading" id="collapseListGroupHeading2" data-toggle="collapse" data-target="#collapseListGroup1" role="tab" >
                        <h4 class="panel-title">
                            基本信息
                            <span class="glyphicon glyphicon-chevron-up right"></span>
                        </h4>
                    </div>
                    <!-- .panel-collapse和.collapse标明折叠元素 .in表示要显示出来 -->
                    <div id="collapseListGroup1" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading1">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <!-- 利用data-target指定URL -->
                                <a href="https://www.baidu.com" target="view_window">网站信息</a>
                            </li>
                            <li class="list-group-item">
                                <!-- 利用data-target指定URL -->
                                <a href="{{url('login888')}}"  target="view_window">网站信息</a>
                            </li>
                            <li class="list-group-item">
                                <!-- 利用data-target指定URL -->
                                <a>分组项1-1</a>
                            </li>
                            <li class="list-group-item">
                                <!-- 利用data-target指定URL -->
                                <a>分组项1-1</a>
                            </li>
                        </ul>
                    </div>
                </div><!--panel end-->
                <div class="panel panel-primary leftMenu">
                    <div class="panel-heading" id="collapseListGroupHeading2" data-toggle="collapse" data-target="#collapseListGroup2" role="tab" >
                        <h4 class="panel-title">
                            分组2
                            <span class="glyphicon glyphicon-chevron-down right"></span>
                        </h4>
                    </div>
                    <div id="collapseListGroup2" class="panel-collapse collapse" role="tabpanel" aria-labelledby="collapseListGroupHeading2">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <button class="menu-item-left">
                                    <span class="glyphicon glyphicon-triangle-right"></span>分组项2-1
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-10" >
            <iframe class="col-md-12" style="height: 100%"  src="http://www.baidu.com" scrolling="yes" name="view_window" ></iframe>
        </div>
    </div>
    <script>
        $(function(){
            $(".panel-heading").click(function(e){
                /*切换折叠指示图标*/
                $(this).find("span").toggleClass("glyphicon-chevron-down");
                $(this).find("span").toggleClass("glyphicon-chevron-up");
            });
        });
    </script>
@endsection