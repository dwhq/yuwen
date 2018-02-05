@extends('public.child')

@section('title', '添加文章')
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
    @include('UEditor::head');
@endsection
@section('content')

    <ol class="breadcrumb">
        <li><a href="#">后台管理</a></li>
        <li><a href="#">文章管理</a></li>
        <li class="active">添加文章</li>
    </ol>
    <div class="panel panel-default">
        <div class="panel-heading h4">
            添加文章
        </div>

        <div class="panel-body">
            @if ($errors->any())
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            错误信息
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            @endif
                <form class="col-md-12" action="{{url('admin/article/store')}}" enctype="multipart/form-data" method="post" id="form" class="center-block " style=" margin: 0 auto;">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">文章标题</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="title" id="title" placeholder="文章标题" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">栏目</label>
                            <div class="col-sm-10">
                                <select class="form-control">
                                    @foreach ($list as $vo)
                                        <option value="{{$vo->type}}">{{$vo->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label"><span class="pull-right">文章缩略图:</span></label>
                            <div class="col-md-10">
                                <div id="uploadimg">
                                    <div id="fileList" class="uploader-list"></div>
                                    <div id="imgPicker">选择缩略图</div>
                                    <p class="state"></p>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label "><span class="pull-right">缩略图地址:</span></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="image" name="image" placeholder="" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">标签:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="desc" id="desc" placeholder="标签之间用英文逗号分开" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">摘要:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="tags" id="tags" placeholder="50个字左右" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">是否显示:</label>
                            <div class="col-sm-10">
                                <label class="radio-inline">
                                    <input type="radio" name="state" id="state" value="1" checked> 显示
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="state" id="state"  value="0"> 不显示
                                </label>
                            </div>
                        </div>
                    </div>
                    <!-- 加载编辑器的容器 -->
                    <div class="panel panel-default col-md-9">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                文章内容:
                            </h4>
                        </div>
                        <div class="panel-body">
                            <script id="container"  name="content" type="text/plain" >

                            </script>
                        </div>
                    </div>


                    <!-- 实例化编辑器 -->
                    <script type="text/javascript">
                        var ue = UE.getEditor('container',{
                            // 设置宽高
                            initialFrameWidth : 900,
                            initialFrameHeight : 600,
                        });
                        ue.ready(function() {
                            ue.execCommand('serverparam', '_token', '{{ csrf_token() }}');//此处为支持laravel5 csrf ,根据实际情况修改,目的就是设置 _token 值.
                        });
                    </script>
                    <div class="col-md-4" style="padding-top: 10px">
                        <button class="btn btn-success  btn-block" style="display: block;">确认保存</button>
                    </div>
                </form>
        </div>
    </div>
    <script type="text/javascript">
        $(function () {
            var $list = $('#thelist'),
                $btn = $('#ctlBtn');

            var uploader = WebUploader.create({
                resize: false, // 不压缩image
                swf: "{{asset('webuploader/uploader.swf')}}", // swf文件路径
                server: "{{url('upload/upload')}}", // 文件接收服务端。
                pick: '#picker', // 选择文件的按钮。可选
                formData: {
                    // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
                    _token:'{{csrf_token()}}'
                    // 我想上传时再请求服务器返回token，改怎么做呢？反复尝试而不得。谢谢大家了！
                    //uptoken_url: '127.0.0.1:8080/examples/upload_token.php'
                },
                chunked: true, //是否要分片处理大文件上传
                chunkSize: 2 * 1024 * 1024 //分片上传，每片2M，默认是5M
                //auto: false //选择文件后是否自动上传
                // chunkRetry : 2, //如果某个分片由于网络问题出错，允许自动重传次数
                //runtimeOrder: 'html5,flash',
                // accept: {
                //   title: 'Images',
                //   extensions: 'gif,jpg,jpeg,bmp,png',
                //   mimeTypes: 'image/*'
                // }
            });
            // 当有文件被添加进队列的时候
            uploader.on('fileQueued', function (file) {
                $list.append('<div id="' + file.id + '" class="item">' +
                    '<h4 class="info">' + file.name + '</h4>' +
                    '<p class="state">等待上传...</p>' +
                    '</div>');
            });
            // 文件上传过程中创建进度条实时显示。
            uploader.on('uploadProgress', function (file, percentage) {
                var $li = $('#' + file.id),
                    $percent = $li.find('.progress .progress-bar');

                // 避免重复创建
                if (!$percent.length) {
                    $percent = $('<div class="progress progress-striped active">' +
                        '<div class="progress-bar" role="progressbar" style="width: 0%">' +
                        '</div>' +
                        '</div>').appendTo($li).find('.progress-bar');
                }

                $li.find('p.state').text('上传中');

                $percent.css('width', percentage * 100 + '%');
            });
            // 文件上传成功
            uploader.on('uploadSuccess', function (file) {
                $('#' + file.id).find('p.state').text('已上传');
            });

            // 文件上传失败，显示上传出错
            uploader.on('uploadError', function (file) {
                $('#' + file.id).find('p.state').text('上传出错');
            });
            // 完成上传完
            uploader.on('uploadComplete', function (file) {
                $('#' + file.id).find('.progress').fadeOut();
            });

            $btn.on('click', function () {
                if ($(this).hasClass('disabled')) {
                    return false;
                }
                uploader.upload();
                // if (state === 'ready') {
                //     uploader.upload();
                // } else if (state === 'paused') {
                //     uploader.upload();
                // } else if (state === 'uploading') {
                //     uploader.stop();
                // }
            });

        });

        //上传图片
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
            swf: "{{asset('webuploader/uploader.swf')}}",

            // 文件接收服务端。
            server: "{{url('upload/upload')}}",

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#imgPicker',
            formData: {
                // 这里的token是外部生成的长期有效的，如果把token写死，是可以上传的。
                _token:'{{csrf_token()}}'
                // 我想上传时再请求服务器返回token，改怎么做呢？反复尝试而不得。谢谢大家了！
                //uptoken_url: '127.0.0.1:8080/examples/upload_token.php'
            },
            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            }
        });

        // 当有文件添加进来的时候
        uploader.on('fileQueued', function (file) {
            var $list = $("#fileList"),
                $li = $(
                    '<div id="' + file.id + '" class="file-item thumbnail">' +
                    '<img>' +
                    '<div class="info">' + file.name + '</div>' +
                    '</div>'
                ),
                $img = $li.find('img');


            // $list为容器jQuery实例
            $list.append($li);

            // 创建缩略图
            // 如果为非图片文件，可以不用调用此方法。
            // thumbnailWidth x thumbnailHeight 为 100 x 100
            uploader.makeThumb(file, function (error, src) {
                if (error) {
                    $img.replaceWith('<span>不能预览</span>');
                    return;
                }

                $img.attr('src', src);
            }, 100, 100);
        });
        // 文件上传过程中创建进度条实时显示。
        uploader.on('uploadProgress', function (file, percentage) {
            var $li = $('#' + file.id),
                $percent = $li.find('.progress span');

            // 避免重复创建
            if (!$percent.length) {
                $percent = $('<p class="progress"><span></span></p>')
                    .appendTo($li)
                    .find('span');
            }

            $percent.css('width', percentage * 100 + '%');
        });

        // 文件上传成功，给item添加成功class, 用样式标记上传成功。
        uploader.on('uploadSuccess', function (file) {
            $('#' + file.id).addClass('upload-state-done');
        });

        // 文件上传失败，显示上传出错。
        uploader.on('uploadError', function (file) {
            var $li = $('#' + file.id),
                $error = $li.find('div.error');

            // 避免重复创建
            if (!$error.length) {
                $error = $('<div class="error"></div>').appendTo($li);
            }
            $error.text('上传失败');
        });
        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on('uploadComplete', function (file) {
            $('#' + file.id).find('.progress').remove();
        });
        uploader.on('uploadSuccess', function (file, data) {
            imgurl = data; //上传图片的路径
            $('#image').val("{{asset('uploads/')}}"+'/'+imgurl._raw);
            console.log(imgurl);
        });
    </script>
@endsection