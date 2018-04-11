<div>
    <style>
        .login:hover
        {background-color:#00a0e9;
        }
    </style>
    <!--导航栏-->
    <div class="row" style="padding: 10px;background-color: #393D49;">
        <div class="col-md-2 col-md-offset-2">
            <a href="{{url('/')}}">
                <img src="{{$info[0]->back==1?config('app.img').$info[0]->image:$info[0]->image}}" alt="{{$info[0]->name}}">
            </a>
        </div>
        <div class="col-md-3 col-md-offset-3">
            <ul class="nav nav-pills">
                @foreach($colum as $colum)
                    <li @if($colum->type==$type)class="active" @endif><a href="{{url('home/'.$colum->type)}}" style="color: white">{{$colum->name}}</a></li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-2">
            @if(session('user_id'))
                <div>
                    <img src="{{$user_info->avatar}}" width="40" class="layui-anim-rotate img-circle" alt="{{$user_info->nickname}}">
                    <span style="color: white">{{$user_info->nickname}}</span>
                    <a href="{{url('/vip/logout/'.$user_info->id)}}" style="color: white">退出</a>
                </div>
                @else
                <a href="javascript:;" class="login col-md-3 text-center" onclick="login()" style="color: white;display: block;padding: 10px 15px;">登 录</a>
            @endif
        </div>
        <div id="login">

        </div>
    </div>
    <script>
        function login(){
            layui.use(['layer'], function(){
                var layer = layui.layer;
                var data = "'正在申请'";
                layer.open({
                    type: 1,
                    title:'无需注册，直接登录',
                    offset: 't',
                    area: '50%',
                    content:
                    '            <div class="col-xs-12 col-md-12 col-lg-12 b-login-row" style="height:100px;margin-top:30px">\n' +
                    '                <ul class="row">\n' +
                    '                    <li class="col-xs-6 col-md-4 col-lg-4 b-login-img">\n' +
                    '                        <a href="javascript:;"><img src="https://baijunyao.com/images/home/qq-login.png" alt="QQ登录" title="QQ登录"></a>\n' +
                    '                    </li>\n' +
                    '                    <li class="col-xs-6 col-md-4 col-lg-4 b-login-img">\n' +
                    '                        <a href="javascript:;"><img src="https://baijunyao.com/images/home/sina-login.png" alt="微博登录" title="微博登录"></a>\n' +
                    '                    </li>\n' +
                    '                    <li class="col-xs-6 col-md-4 col-lg-4 b-login-img">\n' +
                    '                        <a href="{{url('/login/loginGithub')}}"><img src="https://baijunyao.com/images/home/github-login.jpg" alt="github登录" title="github登录"></a>\n' +
                    '                    </li>\n' +
                    '                </ul>\n' +
                    '            </div>\n' //这里content是一个普通的String
                });
            });
        }
    </script>
</div>