<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
<div>
    <div id="blog"  style="width: 100%;background:url('{{asset('/image/blog_01.jpg')}}');">
        <div style="height: 14px;padding-top: 14px">
            <div style="width: 180px;
                float:left;
                margin-left: 270px;
                font-family: PingFangSC-Medium;
                font-weight: normal;
                font-stretch: normal;
                letter-spacing: 4px;
                color: #37424d;">•PHP交流学习中心•</div>
            <div style="margin-right:290px;text-align:center;float:right;width: 72px;line-height:30px;height: 30px;background-color: #2869df;font-size: 12px;color: #ffffff;box-shadow: 0px 10px 12px 0px rgba(10, 30, 68, 0.2);border-radius: 5px;">
                登录</div>
            <div >
                <div style="width:135px;letter-spacing: 4px;color: #e0e3e4;margin: 760px auto 28px auto">
                    下拉展开新世界!
                </div>
                    <img class="center-block" onclick="" style="width: 58px;height: 58px;box-shadow: 0px 0px 15px 0px rgba(0, 0, 0, 0.1);margin: 0 auto" src="{{asset('image/down.png')}}" alt="">
            </div>
        </div>
    </div>
</div>
</body>
<script>
   window.onload = function(){
       console.log(window.innerHeight)
       document.getElementById("blog").style.height = window.innerHeight+'px';
       if (window.innerWidth > 2000){
           {{--document.querySelector('#blog').style.backgroundImage="{{asset('image/blog_02.jpg')}}"--}}
           document.getElementById("blog").style.backgroundImage="url("+'image/blog_02.jpg'+")";
       }
   }
</script>
</html>