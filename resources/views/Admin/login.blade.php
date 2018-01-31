@extends('public.child')

@section('title', '登陆网站')

@section('content')
    <div style="">
        <div  style="padding:10% 0 0 0;width: 20%;margin: 0 auto;height: 100%">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">登陆网站</h3>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" action="{{url('dwhq/login')}}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">用户名:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="name" id="name" placeholder="用户名">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="firstname" class="col-sm-3 control-label">密码</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="password"  id="password" placeholder="密码">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3">{!! Captcha::img() !!}</div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="captcha"  id="vertify" placeholder="请输入验证码">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success btn-block"> 登 陆 </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection