@extends('public.child')

@section('title', '登陆网站')

@section('content')
    <div style="">
        <div  style="padding:10% 0 0 0;width: 20%;margin: 0 auto;height: 100%">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">登陆网站</h3>
                </div>
                <div id="myAlert" class="alert alert-warning" hidden>
                    <a href="#" class="close" data-dismiss="alert">&times;</a>
                    <div id="info">

                    </div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" >
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
                            <div class="col-sm-3">
                                <img src="{{captcha_src()}}" onclick="this.src=this.src+'?'" alt="点击刷新"></div>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="captcha"  id="captcha" placeholder="请输入验证码">
                            </div>
                        </div>
                        <button type="button" class="btn btn-success btn-block" id="button"> 登 陆 </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
        <script type="text/javascript">
        $(function () {
            $('#button').click(function () {
                var name = $('#name').val();
                var password = $('#password').val();
                var vertify = $('#vertify').val();
                if (name == '') {
                    alert('账户不能为空')
                    return false;
                } else if (password == '') {
                    alert('密码不能为空')
                    return false;
                } else if (vertify == '') {
                    alert('验证码不能为空')
                    return false;
                }

                $.post("{{url('login')}}", {'name': $('#name').val(), 'password': $('#password').val(),'_token':"{{csrf_token()}}", 'captcha': $('#captcha').val()}, function (data) {
                    if (data.state == 1) {
                        location.href = data.url;
                    } else {
                        $("#info").html("<strong>警告！</strong>"+data.info);
                        $("#myAlert").show();
                    }
                }, 'json');
            })
        })
        $(function(){
            $(".close").click(function(){
                $("#myAlert").hide();
            });
        });
    </script>

@endsection