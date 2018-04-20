<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>测试页面</title>
</head>
<body>
<form action="{{url('demo')}}" method="post">
    {{csrf_field()}}
    账号：<input type="text" name="id"></br>
    密码：<input type="text" name="password"></br>
    <input type="submit" value="提交">
</form>
</body>
</html>