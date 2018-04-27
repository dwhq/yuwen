@extends('public.child')

@section('title', '添加模板')
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
        <li><a href="#">权限管理</a></li>
        <li class="active">添加模板</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">
                添加模板
            </h3>
        </div>
        <div class="panel-body">
            <form class="layui-form col-md-4 center-block" action="{{url('admin/manage/add_url/'.$data->id)}}"  method="post">
                <div class="layui-form-item">
                    <label class="layui-form-label">名称:</label>
                    <div class="layui-input-block">
                        {{--pattern="[\u4e00-\u9fa5]{2,}" 验证表单的正则表单   required 表单不能为空--}}
                        <input type="name" name="name" id="name" required value="{{$data->name}}"  lay-verify="required" placeholder="请输入名称" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">点击选择图标:</label>
                    <div class="layui-input-block">
                        <div>
                            <span class="glyphicon glyphicon-asterisk" onclick="iocn('glyphicon glyphicon-asterisk')"></span>
                            <span class="glyphicon glyphicon-plus" onclick="iocn('glyphicon glyphicon-plus')"></span>
                            <span class="glyphicon glyphicon-minus" onclick="iocn('glyphicon glyphicon-minus')"></span>
                            <span class="glyphicon glyphicon-euro" onclick="iocn('glyphicon glyphicon-euro')"></span>
                            <span class="glyphicon glyphicon-cloud" onclick="iocn('glyphicon glyphicon-cloud')"></span>
                            <span class="glyphicon glyphicon-envelope" onclick="iocn('glyphicon glyphicon-envelope')"></span>
                            <span class="glyphicon glyphicon-pencil" onclick="iocn('glyphicon glyphicon-pencil')"></span>
                            <span class="glyphicon glyphicon-glass" onclick="iocn('glyphicon glyphicon-glass')"></span>
                            <span class="glyphicon glyphicon-music" onclick="iocn('glyphicon glyphicon-music')"></span>
                            <span class="glyphicon glyphicon-search" onclick="iocn('glyphicon glyphicon-search')"></span>
                            <span class="glyphicon glyphicon-heart" onclick="iocn('glyphicon glyphicon-heart')"></span>
                            <span class="glyphicon glyphicon-star" onclick="iocn('glyphicon glyphicon-star')"></span>
                            <span class="glyphicon glyphicon-star-empty" onclick="iocn('glyphicon glyphicon-star-empty')"></span>
                            <span class="glyphicon glyphicon-user" onclick="iocn('glyphicon glyphicon-user')"></span>
                            <span class="glyphicon glyphicon-film" onclick="iocn('glyphicon glyphicon-film')"></span>
                            <span class="glyphicon glyphicon-th-large" onclick="iocn('glyphicon glyphicon-th-large')"></span>
                            <span class="glyphicon glyphicon-th" onclick="iocn('glyphicon glyphicon-th')"></span>
                            <span class="glyphicon glyphicon-th-list" onclick="iocn('glyphicon glyphicon-th-list')"></span>
                            <span class="glyphicon glyphicon-ok" onclick="iocn('glyphicon glyphicon-ok')"></span>
                            <span class="glyphicon glyphicon-remove" onclick="iocn('glyphicon glyphicon-remove')"></span>
                            <span class="glyphicon glyphicon-zoom-in" onclick="iocn('glyphicon glyphicon-zoom-in')"></span>
                            <span class="glyphicon glyphicon-zoom-out" onclick="iocn('glyphicon glyphicon-zoom-out')"></span>
                            <span class="glyphicon glyphicon-off" onclick="iocn('glyphicon glyphicon-off')"></span>
                            <span class="glyphicon glyphicon-signal" onclick="iocn('glyphicon glyphicon-signal')"></span>
                            <span class="glyphicon glyphicon-cog" onclick="iocn('glyphicon glyphicon-cog')"></span>
                            <span class="glyphicon glyphicon-trash" onclick="iocn('glyphicon glyphicon-trash')"></span>
                            <span class="glyphicon glyphicon-home" onclick="iocn('glyphicon glyphicon-home')"></span>
                            <span class="glyphicon glyphicon-file" onclick="iocn('glyphicon glyphicon-file')"></span>
                            <span class="glyphicon glyphicon-time" onclick="iocn('glyphicon glyphicon-time')"></span>
                            <span class="glyphicon glyphicon-road" onclick="iocn('glyphicon glyphicon-road')"></span>
                            <span class="glyphicon glyphicon-download-alt" onclick="iocn('glyphicon glyphicon-download-alt')"></span>
                            <span class="glyphicon glyphicon-download" onclick="iocn('glyphicon glyphicon-download')"></span>
                            <span class="glyphicon glyphicon-upload" onclick="iocn('glyphicon glyphicon-upload')"></span>
                            <span class="glyphicon glyphicon-inbox" onclick="iocn('glyphicon glyphicon-inbox')"></span>
                            <span class="glyphicon glyphicon-play-circle" onclick="iocn('glyphicon glyphicon-play-circle')"></span>
                            <span class="glyphicon glyphicon-repeat" onclick="iocn('glyphicon glyphicon-repeat')"></span>
                            <span class="glyphicon glyphicon-refresh" onclick="iocn('glyphicon glyphicon-refresh')"></span>
                            <span class="glyphicon glyphicon-list-alt" onclick="iocn('glyphicon glyphicon-list-alt')"></span>
                            <span class="glyphicon glyphicon-lock" onclick="iocn('glyphicon glyphicon-lock')"></span>
                            <span class="glyphicon glyphicon-flag" onclick="iocn('glyphicon glyphicon-flag')"></span>
                            <span class="glyphicon glyphicon-headphones" onclick="iocn('glyphicon glyphicon-headphones')"></span>
                            <span class="glyphicon glyphicon-volume-off" onclick="iocn('glyphicon glyphicon-volume-off')"></span>
                            <span class="glyphicon glyphicon-volume-down" onclick="iocn('glyphicon glyphicon-volume-down')"></span>
                            <span class="glyphicon glyphicon-volume-up" onclick="iocn('glyphicon glyphicon-volume-up')"></span>
                            <span class="glyphicon glyphicon-qrcode" onclick="iocn('glyphicon glyphicon-qrcode')"></span>
                            <span class="glyphicon glyphicon-barcode" onclick="iocn('glyphicon glyphicon-barcode')"></span>
                            <span class="glyphicon glyphicon-tag" onclick="iocn('glyphicon glyphicon-tag')"></span>
                            <span class="glyphicon glyphicon-tags" onclick="iocn('glyphicon glyphicon-tags')"></span>
                            <span class="glyphicon glyphicon-book" onclick="iocn('glyphicon glyphicon-book')"></span>
                            <span class="glyphicon glyphicon-bookmark" onclick="iocn('glyphicon glyphicon-bookmark')"></span>
                            <span class="glyphicon glyphicon-print" onclick="iocn('glyphicon glyphicon-print')"></span>
                            <span class="glyphicon glyphicon-camera" onclick="iocn('glyphicon glyphicon-camera')"></span>
                            <span class="glyphicon glyphicon-font" onclick="iocn('glyphicon glyphicon-font')"></span>
                            <span class="glyphicon glyphicon-bold" onclick="iocn('glyphicon glyphicon-bold')"></span>
                            <span class="glyphicon glyphicon-italic" onclick="iocn('glyphicon glyphicon-italic')"></span>
                            <span class="glyphicon glyphicon-text-height" onclick="iocn('glyphicon glyphicon-text-height')"></span>
                            <span class="glyphicon glyphicon-text-width" onclick="iocn('glyphicon glyphicon-text-width')"></span>
                            <span class="glyphicon glyphicon-align-left" onclick="iocn('glyphicon glyphicon-align-left')"></span>
                            <span class="glyphicon glyphicon-align-center" onclick="iocn('glyphicon glyphicon-align-center')"></span>
                            <span class="glyphicon glyphicon-align-right" onclick="iocn('glyphicon glyphicon-align-right')"></span>
                            <span class="glyphicon glyphicon-align-justify" onclick="iocn('glyphicon glyphicon-align-justify')"></span>
                            <span class="glyphicon glyphicon-list" onclick="iocn('glyphicon glyphicon-list')"></span>
                            <span class="glyphicon glyphicon-indent-left" onclick="iocn('glyphicon glyphicon-indent-left')"></span>
                            <span class="glyphicon glyphicon-indent-right" onclick="iocn('glyphicon glyphicon-indent-right')"></span>
                            <span class="glyphicon glyphicon-facetime-video" onclick="iocn('glyphicon glyphicon-facetime-video')"></span>
                            <span class="glyphicon glyphicon-picture" onclick="iocn('glyphicon glyphicon-picture')"></span>
                            <span class="glyphicon glyphicon-map-marker" onclick="iocn('glyphicon glyphicon-map-marker')"></span>
                            <span class="glyphicon glyphicon-adjust" onclick="iocn('glyphicon glyphicon-adjust')"></span>
                            <span class="glyphicon glyphicon-tint" onclick="iocn('glyphicon glyphicon-tint')"></span>
                            <span class="glyphicon glyphicon-edit" onclick="iocn('glyphicon glyphicon-edit')"></span>
                            <span class="glyphicon glyphicon-share" onclick="iocn('glyphicon glyphicon-share')"></span>
                            <span class="glyphicon glyphicon-check" onclick="iocn('glyphicon glyphicon-check')"></span>
                            <span class="glyphicon glyphicon-move" onclick="iocn('glyphicon glyphicon-move')"></span>
                            <span class="glyphicon glyphicon-step-backward" onclick="iocn('glyphicon glyphicon-step-backward')"></span>
                            <span class="glyphicon glyphicon-fast-backward" onclick="iocn('glyphicon glyphicon-fast-backward')"></span>
                            <span class="glyphicon glyphicon-backward" onclick="iocn('glyphicon glyphicon-backward')"></span>
                            <span class="glyphicon glyphicon-play" onclick="iocn('glyphicon glyphicon-play')"></span>
                            <span class="glyphicon glyphicon-pause" onclick="iocn('glyphicon glyphicon-pause')"></span>
                            <span class="glyphicon glyphicon-stop" onclick="iocn('glyphicon glyphicon-stop')"></span>
                            <span class="glyphicon glyphicon-forward" onclick="iocn('glyphicon glyphicon-forward')"></span>
                            <span class="glyphicon glyphicon-fast-forward" onclick="iocn('glyphicon glyphicon-fast-forward')"></span>
                            <span class="glyphicon glyphicon-step-forward" onclick="iocn('glyphicon glyphicon-step-forward')"></span>
                            <span class="glyphicon glyphicon-eject" onclick="iocn('glyphicon glyphicon-eject')"></span>
                            <span class="glyphicon glyphicon-chevron-left" onclick="iocn('glyphicon glyphicon-chevron-left')"></span>
                            <span class="glyphicon glyphicon-chevron-right" onclick="iocn('glyphicon glyphicon-chevron-right')"></span>
                            <span class="glyphicon glyphicon-plus-sign" onclick="iocn('glyphicon glyphicon-plus-sign')"></span>
                            <span class="glyphicon glyphicon-minus-sign" onclick="iocn('glyphicon glyphicon-minus-sign')"></span>
                            <span class="glyphicon glyphicon-remove-sign" onclick="iocn('glyphicon glyphicon-remove-sign')"></span>
                            <span class="glyphicon glyphicon-ok-sign" onclick="iocn('glyphicon glyphicon-ok-sign')"></span>
                            <span class="glyphicon glyphicon-question-sign" onclick="iocn('glyphicon glyphicon-question-sign')"></span>
                            <span class="glyphicon glyphicon-info-sign" onclick="iocn('glyphicon glyphicon-info-sign')"></span>
                            <span class="glyphicon glyphicon-screenshot" onclick="iocn('glyphicon glyphicon-screenshot')"></span>
                            <span class="glyphicon glyphicon-remove-circle" onclick="iocn('glyphicon glyphicon-remove-circle')"></span>
                            <span class="glyphicon glyphicon-ok-circle" onclick="iocn('glyphicon glyphicon-ok-circle')"></span>
                            <span class="glyphicon glyphicon-ban-circle" onclick="iocn('glyphicon glyphicon-ban-circle')"></span>
                            <span class="glyphicon glyphicon-arrow-left" onclick="iocn('glyphicon glyphicon-arrow-left')"></span>
                            <span class="glyphicon glyphicon-arrow-right" onclick="iocn('glyphicon glyphicon-arrow-right')"></span>
                            <span class="glyphicon glyphicon-arrow-up" onclick="iocn('glyphicon glyphicon-arrow-up')"></span>
                            <span class="glyphicon glyphicon-arrow-down" onclick="iocn('glyphicon glyphicon-arrow-down')"></span>
                            <span class="glyphicon glyphicon-share-alt" onclick="iocn('glyphicon glyphicon-share-alt')"></span>
                            <span class="glyphicon glyphicon-resize-full" onclick="iocn('glyphicon glyphicon-resize-full')"></span>
                            <span class="glyphicon glyphicon-resize-small" onclick="iocn('glyphicon glyphicon-resize-small')"></span>
                            <span class="glyphicon glyphicon-exclamation-sign" onclick="iocn('glyphicon glyphicon-exclamation-sign')"></span>
                            <span class="glyphicon glyphicon-gift" onclick="iocn('glyphicon glyphicon-gift')"></span>
                            <span class="glyphicon glyphicon-leaf" onclick="iocn('glyphicon glyphicon-leaf')"></span>
                            <span class="glyphicon glyphicon-fire" onclick="iocn('glyphicon glyphicon-fire')"></span>
                            <span class="glyphicon glyphicon-eye-open" onclick="iocn('glyphicon glyphicon-eye-open')"></span>
                            <span class="glyphicon glyphicon-eye-close" onclick="iocn('glyphicon glyphicon-eye-close')"></span>
                            <span class="glyphicon glyphicon-warning-sign" onclick="iocn('glyphicon glyphicon-warning-sign')"></span>
                            <span class="glyphicon glyphicon-plane" onclick="iocn('glyphicon glyphicon-plane')"></span>
                            <span class="glyphicon glyphicon-calendar" onclick="iocn('glyphicon glyphicon-calendar')"></span>
                            <span class="glyphicon glyphicon-random" onclick="iocn('glyphicon glyphicon-random')"></span>
                            <span class="glyphicon glyphicon-comment" onclick="iocn('glyphicon glyphicon-comment')"></span>
                            <span class="glyphicon glyphicon-magnet" onclick="iocn('glyphicon glyphicon-magnet')"></span>
                            <span class="glyphicon glyphicon-chevron-up" onclick="iocn('glyphicon glyphicon-chevron-up')"></span>
                            <span class="glyphicon glyphicon-chevron-down" onclick="iocn('glyphicon glyphicon-chevron-down')"></span>
                            <span class="glyphicon glyphicon-retweet" onclick="iocn('glyphicon glyphicon-retweet')"></span>
                            <span class="glyphicon glyphicon-shopping-cart" onclick="iocn('glyphicon glyphicon-shopping-cart')"></span>
                            <span class="glyphicon glyphicon-folder-close" onclick="iocn('glyphicon glyphicon-folder-close')"></span>
                            <span class="glyphicon glyphicon-folder-open" onclick="iocn('glyphicon glyphicon-folder-open')"></span>
                            <span class="glyphicon glyphicon-resize-vertical" onclick="iocn('glyphicon glyphicon-resize-vertical')"></span>
                            <span class="glyphicon glyphicon-resize-horizontal" onclick="iocn('glyphicon glyphicon-resize-horizontal')"></span>
                            <span class="glyphicon glyphicon-hdd" onclick="iocn('glyphicon glyphicon-hdd')"></span>
                            <span class="glyphicon glyphicon-bullhorn" onclick="iocn('glyphicon glyphicon-bullhorn')"></span>
                            <span class="glyphicon glyphicon-bell" onclick="iocn('glyphicon glyphicon-bell')"></span>
                            <span class="glyphicon glyphicon-certificate" onclick="iocn('glyphicon glyphicon-certificate')"></span>
                            <span class="glyphicon glyphicon-thumbs-up" onclick="iocn('glyphicon glyphicon-thumbs-up')"></span>
                            <span class="glyphicon glyphicon-thumbs-down" onclick="iocn('glyphicon glyphicon-thumbs-down')"></span>
                            <span class="glyphicon glyphicon-hand-right" onclick="iocn('glyphicon glyphicon-hand-right')"></span>
                            <span class="glyphicon glyphicon-hand-left" onclick="iocn('glyphicon glyphicon-hand-left')"></span>
                            <span class="glyphicon glyphicon-hand-up" onclick="iocn('glyphicon glyphicon-hand-up')"></span>
                            <span class="glyphicon glyphicon-hand-down" onclick="iocn('glyphicon glyphicon-hand-down')"></span>
                            <span class="glyphicon glyphicon-circle-arrow-right" onclick="iocn('glyphicon glyphicon-circle-arrow-right')"></span>
                            <span class="glyphicon glyphicon-circle-arrow-left" onclick="iocn('glyphicon glyphicon-circle-arrow-left')"></span>
                            <span class="glyphicon glyphicon-circle-arrow-up" onclick="iocn('glyphicon glyphicon-circle-arrow-up')"></span>
                            <span class="glyphicon glyphicon-circle-arrow-down" onclick="iocn('glyphicon glyphicon-circle-arrow-down')"></span>
                            <span class="glyphicon glyphicon-globe" onclick="iocn('glyphicon glyphicon-globe')"></span>
                            <span class="glyphicon glyphicon-wrench" onclick="iocn('glyphicon glyphicon-wrench')"></span>
                            <span class="glyphicon glyphicon-tasks" onclick="iocn('glyphicon glyphicon-tasks')"></span>
                            <span class="glyphicon glyphicon-filter" onclick="iocn('glyphicon glyphicon-filter')"></span>
                            <span class="glyphicon glyphicon-briefcase" onclick="iocn('glyphicon glyphicon-briefcase')"></span>
                            <span class="glyphicon glyphicon-fullscreen" onclick="iocn('glyphicon glyphicon-fullscreen')"></span>
                            <span class="glyphicon glyphicon-dashboard" onclick="iocn('glyphicon glyphicon-dashboard')"></span>
                            <span class="glyphicon glyphicon-paperclip" onclick="iocn('glyphicon glyphicon-paperclip')"></span>
                            <span class="glyphicon glyphicon-heart-empty" onclick="iocn('glyphicon glyphicon-heart-empty')"></span>
                            <span class="glyphicon glyphicon-link" onclick="iocn('glyphicon glyphicon-link')"></span>
                            <span class="glyphicon glyphicon-phone" onclick="iocn('glyphicon glyphicon-phone')"></span>
                            <span class="glyphicon glyphicon-pushpin" onclick="iocn('glyphicon glyphicon-pushpin')"></span>
                            <span class="glyphicon glyphicon-usd" onclick="iocn('glyphicon glyphicon-usd')"></span>
                            <span class="glyphicon glyphicon-gbp" onclick="iocn('glyphicon glyphicon-gbp')"></span>
                            <span class="glyphicon glyphicon-sort" onclick="iocn('glyphicon glyphicon-sort')"></span>
                            <span class="glyphicon glyphicon-sort-by-alphabet" onclick="iocn('glyphicon glyphicon-sort-by-alphabet')"></span>
                            <span class="glyphicon glyphicon-sort-by-alphabet-alt" onclick="iocn('glyphicon glyphicon-sort-by-alphabet-alt')"></span>
                            <span class="glyphicon glyphicon-sort-by-order" onclick="iocn('glyphicon glyphicon-sort-by-order')"></span>
                            <span class="glyphicon glyphicon-sort-by-order-alt" onclick="iocn('glyphicon glyphicon-sort-by-order-alt')"></span>
                            <span class="glyphicon glyphicon-sort-by-attributes" onclick="iocn('glyphicon glyphicon-sort-by-attributes')"></span>
                            <span class="glyphicon glyphicon-sort-by-attributes-alt" onclick="iocn('glyphicon glyphicon-sort-by-attributes-alt')"></span>
                            <span class="glyphicon glyphicon-unchecked" onclick="iocn('glyphicon glyphicon-unchecked')"></span>
                            <span class="glyphicon glyphicon-expand" onclick="iocn('glyphicon glyphicon-expand')"></span>
                            <span class="glyphicon glyphicon-collapse-down" onclick="iocn('glyphicon glyphicon-collapse-down')"></span>
                            <span class="glyphicon glyphicon-collapse-up" onclick="iocn('glyphicon glyphicon-collapse-up')"></span>
                            <span class="glyphicon glyphicon-log-in" onclick="iocn('glyphicon glyphicon-log-in')"></span>
                            <span class="glyphicon glyphicon-flash" onclick="iocn('glyphicon glyphicon-flash')"></span>
                            <span class="glyphicon glyphicon-log-out" onclick="iocn('glyphicon glyphicon-log-out')"></span>
                            <span class="glyphicon glyphicon-new-window" onclick="iocn('glyphicon glyphicon-new-window')"></span>
                            <span class="glyphicon glyphicon-record" onclick="iocn('glyphicon glyphicon-record')"></span>
                            <span class="glyphicon glyphicon-save" onclick="iocn('glyphicon glyphicon-save')"></span>
                            <span class="glyphicon glyphicon-open" onclick="iocn('glyphicon glyphicon-open')"></span>
                            <span class="glyphicon glyphicon-saved" onclick="iocn('glyphicon glyphicon-saved')"></span>
                            <span class="glyphicon glyphicon-import" onclick="iocn('glyphicon glyphicon-import')"></span>
                            <span class="glyphicon glyphicon-export" onclick="iocn('glyphicon glyphicon-export')"></span>
                            <span class="glyphicon glyphicon-send" onclick="iocn('glyphicon glyphicon-send')"></span>
                            <span class="glyphicon glyphicon-floppy-disk" onclick="iocn('glyphicon glyphicon-floppy-disk')"></span>
                            <span class="glyphicon glyphicon-floppy-saved" onclick="iocn('glyphicon glyphicon-floppy-saved')"></span>
                            <span class="glyphicon glyphicon-floppy-remove" onclick="iocn('glyphicon glyphicon-floppy-remove')"></span>
                            <span class="glyphicon glyphicon-floppy-save" onclick="iocn('glyphicon glyphicon-floppy-save')"></span>
                            <span class="glyphicon glyphicon-floppy-open" onclick="iocn('glyphicon glyphicon-floppy-open')"></span>
                            <span class="glyphicon glyphicon-credit-card" onclick="iocn('glyphicon glyphicon-credit-card')"></span>
                            <span class="glyphicon glyphicon-transfer" onclick="iocn('glyphicon glyphicon-transfer')"></span>
                            <span class="glyphicon glyphicon-cutlery" onclick="iocn('glyphicon glyphicon-cutlery')"></span>
                            <span class="glyphicon glyphicon-header" onclick="iocn('glyphicon glyphicon-header')"></span>
                            <span class="glyphicon glyphicon-compressed" onclick="iocn('glyphicon glyphicon-compressed')"></span>
                            <span class="glyphicon glyphicon-earphone" onclick="iocn('glyphicon glyphicon-earphone')"></span>
                            <span class="glyphicon glyphicon-phone-alt" onclick="iocn('glyphicon glyphicon-phone-alt')"></span>
                            <span class="glyphicon glyphicon-tower" onclick="iocn('glyphicon glyphicon-tower')"></span>
                            <span class="glyphicon glyphicon-stats" onclick="iocn('glyphicon glyphicon-stats')"></span>
                            <span class="glyphicon glyphicon-sd-video" onclick="iocn('glyphicon glyphicon-sd-video')"></span>
                            <span class="glyphicon glyphicon-hd-video" onclick="iocn('glyphicon glyphicon-hd-video')"></span>
                            <span class="glyphicon glyphicon-subtitles" onclick="iocn('glyphicon glyphicon-subtitles')"></span>
                            <span class="glyphicon glyphicon-sound-stereo" onclick="iocn('glyphicon glyphicon-sound-stereo')"></span>
                            <span class="glyphicon glyphicon-sound-dolby" onclick="iocn('glyphicon glyphicon-sound-dolby')"></span>
                            <span class="glyphicon glyphicon-sound-5-1" onclick="iocn('glyphicon glyphicon-sound-5-1')"></span>
                            <span class="glyphicon glyphicon-sound-6-1" onclick="iocn('glyphicon glyphicon-sound-6-1')"></span>
                            <span class="glyphicon glyphicon-sound-7-1" onclick="iocn('glyphicon glyphicon-sound-7-1')"></span>
                            <span class="glyphicon glyphicon-copyright-mark" onclick="iocn('glyphicon glyphicon-copyright-mark')"></span>
                            <span class="glyphicon glyphicon-registration-mark" onclick="iocn('glyphicon glyphicon-registration-mark')"></span>
                            <span class="glyphicon glyphicon-cloud-download" onclick="iocn('glyphicon glyphicon-cloud-download')"></span>
                            <span class="glyphicon glyphicon-cloud-upload" onclick="iocn('glyphicon glyphicon-cloud-upload')"></span>
                            <span class="glyphicon glyphicon-tree-conifer" onclick="iocn('glyphicon glyphicon-tree-conifer')"></span>
                            <span class="glyphicon glyphicon-tree-deciduous" onclick="iocn('glyphicon glyphicon-tree-deciduous')"></span>
                        </div>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">图标:</label>
                    <div class="layui-input-block">
                        <input type="name" name="icon" id="icon" value="{{$data->icon}}" required   lay-verify="required" placeholder="也可以直接输入icon编号" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">路由地址</label>
                    <div class="layui-input-block">
                        {{--pattern="[\u4e00-\u9fa5]{2,}" 验证表单的正则表单   required 表单不能为空--}}
                        <input type="name" name="url" id="url" required @if($data->father_id == 0)readonly="true" value="#"@endif lay-verify="required" placeholder="请输地址" autocomplete="off" class="layui-input">
                    </div>
                </div>
                {{ csrf_field() }}
                <div class="layui-form-item">
                    <label class="layui-form-label">是否显示:</label>
                    <div class="layui-input-block">
                        <input type="checkbox" class="checkbox" @if($data->status == 1) checked @endif value="1" name="status" title="显示">
                    </div>
                </div>
                <button id="btn" class="layui-btn layui-btn-normal layui-btn-fluid">提 交</button>
            </form>
        </div>
    </div>
    <script>
        //只有执行了这一步，部分表单元素才会自动修饰成功
        layui.use('form', function(){
            //var form = layui.form;

            //form.render();
        });
        function iocn(icon) {
            $('#icon').val(icon);
        }
        if(@json($state) == 1 ){
            window.parent.location.reload();
            parent.layer.close();
        }
    </script>
@endsection