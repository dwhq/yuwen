<div>
    <div class="row" style="padding:10px 0 10px 0 ">
        <div class="col-lg-8 ">
            <input type="text" class="form-control" placeholder="全文搜索">
        </div>
        <button type="button" class="btn btn-success col-lg-3">全文搜索</button>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title ">联系站长</h3>
        </div>
        @if($info[0]->qq)
        <div class="panel-body h4">
            QQ : {{$info[0]->qq}}
        </div>
        @endif
        @if($info[0]->email)
        <div class="panel-body h4">
            email : {{$info[0]->email}}
        </div>
        @endif
        @if($info[0]->mobile)
        <div class="panel-body h4">
            电话 : {{$info[0]->mobile}}
        </div>
        @endif
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">热门标签</h3>
        </div>
        <div class="panel-body">
            @foreach($tag as $tag)
                <a href="{{url('/')}}" class="col-md-3 " style="margin: 5px;border-radius: 10px;background: #e7e7e7;text-decoration: none;">{{$tag->name}}</a>
            @endforeach
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">最新文章</h3>
        </div>
        @foreach($new_article as $list)
            <div class="panel-body">
                <a href="#/content?id=25" class="thumbnail clearfix aft" title="{{$list->title}}" target="_blank">
                                    <span class=" clearfix col-lg-5">
                                    <img src="{{config('app.img').$list->pic}}" alt="{{$list->title}}" class="img-rounded " style="display: block;width: 122px; height:86px">
                                    </span>
                    <span class="text" class="col-lg-6 text-muted">{{$list->title}}</span><br/>
                    <span class="muted" class="col-lg-6 text-muted">
                                    <i class="glyphicon glyphicon-time"></i>{{date('Y-m-d H:i',$list->time)}}</span>
                    <span class="muted"></span>
                </a>
            </div>
        @endforeach
    </div>
    <div class="panel panel-info hidden">
        <div class="panel-heading ">
            <h3 class="panel-title">最新留言</h3>
        </div>
        <div class="panel-body">
            <a  href="https://www.kancloud.cn/manual/thinkphp5/118003" title="17点" target="_blank">17点</a>&nbsp;&nbsp;&nbsp;
        </div>
    </div>
    <div class="panel panel-info">
        <div class="panel-heading">
            <h3 class="panel-title">友情链接</h3>
        </div>
        @foreach($url as $url)
            <div class="panel-body">
                <span class="glyphicon glyphicon-hand-right">&nbsp;</span>
                <a  href="{{$url->url}}" title="{{$url->title}}" target="_blank">{{$url->title}}</a>&nbsp;&nbsp;&nbsp;
            </div>
        @endforeach
    </div>
</div>
