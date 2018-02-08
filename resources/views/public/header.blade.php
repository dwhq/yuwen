<div>
    <!--导航栏-->
    <div class="row" style="padding: 10px">
        <div class="col-md-2 col-md-offset-2">
            <a href="{{url('/')}}">
                <img src="{{$info[0]->back==1?config('app.img').$info[0]->image:$info[0]->image}}" alt="{{$info[0]->name}}">
            </a>
        </div>
        <div class="col-md-3 col-md-offset-3">
            <ul class="nav nav-pills">
                @foreach($colum as $colum)
                    <li @if($colum->type==$type)class="active" @endif><a href="{{url('home/'.$colum->type)}}">{{$colum->name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>