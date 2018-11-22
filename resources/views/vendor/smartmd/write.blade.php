<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Fresh Air') }}</title>
    <link rel="stylesheet" href="{{asset("css/app.css")}}">
    @include('Smartmd::head')
    <style>
        body{
            background: white;
        }
    </style>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row justify-content-center p-5">
            <div class="col-10 mb-4 text-center">
                <img src="https://xiaoqingxin.site/images/default_img.jpg" alt="im" class="col-12">
            </div>
            <div class="col-10">
                <div class="editor">
                <textarea id="editor" placeholder="请输入正文" style="display: none"></textarea>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var smartmd = new Smartmd();

    if (document.body.clientWidth > 1200) {
        smartmd.toggleSideBySide();
        // smartmd.alert("success","preview init success");
    }

    // console.log(smartmd.realValue());
    // var cm = smartmd.codemirror;
    // cm.display.lineDiv.ondrop = function(ev){
    //     if(ev.target.className.indexOf("CodeMirror-line") > -1){
    //         your drop down function
    //     }
    //     return false;
    // }
</script>
</body>