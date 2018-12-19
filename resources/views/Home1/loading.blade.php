<!--引导页-->
<div class="guideW">
    <div class="guide">
        <img src="/image/loading.gif" alt="">
    </div>
    <div class="data">
        <div class="mid">
            <i class="dd1"></i>
            <i class="dd2"></i>
            <i class="dd3"></i>
            <i class="dd4"></i>
            <i class="dd5"></i>
            <i class="dd0"></i>
            <i class="dd6"></i>
            <i class="dd7"></i>
            <i class="dd8"></i>
            <i class="dd9"></i>
            <i class="dd10"></i>
        </div>
        <div class="left">
            <i class="dd1"></i>
            <i class="dd2"></i>
            <i class="dd3"></i>
            <i class="dd4"></i>
            <i class="dd5"></i>
        </div>
        <span><i class="text">0</i>%</span>
        <div class="right">
            <i class="dd1"></i>
            <i class="dd2"></i>
            <i class="dd3"></i>
            <i class="dd4"></i>
            <i class="dd5"></i>
        </div>
    </div>
</div>
<style>
    a:hover {
        text-decoration: none
    }

    /*底部*/
    .guideW {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #f2f2f2;
        z-index: 101;
    }

    .guide {
        position: absolute;
        left: 50%;
        margin-left: -80px;
        top: 50%;
        margin-top: -83px;
    }

    .guide img {
        width: 160px;
    }

    .guideW .data {
        position: absolute;
        width: 224px;
        text-align: center;
        bottom: 20px;
        left: 50%;
        margin-left: -112px;
        font-size: 22px;
        font-family: "Trajan Pro"
    }

    .guideW .data span i {
        font-style: normal;
    }

    .guideW .data .left {
        width: 86px;
        height: 23px;
        position: absolute;
        top: 0;
        left: 0;
    }

    .guideW .data .left i {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #cc5161;
        display: block;
        float: left;
        margin: 10px 12px 0 0;
    }

    .guideW .data .right {
        width: 86px;
        height: 23px;
        position: absolute;
        top: 0;
        right: 0;
    }

    .guideW .data .right i {
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: #cc5161;
        display: block;
        float: right;
        margin: 10px 0 0 12px;
    }

    .guideW .data .left i.dd5 {
        animation: ani5 .25s infinite;
    }

    .guideW .data .left i.dd4 {
        animation: ani4 .25s infinite;
    }

    .guideW .data .left i.dd3 {
        animation: ani3 .25s infinite;
    }

    .guideW .data .left i.dd2 {
        animation: ani2 .25s infinite;
    }

    .guideW .data .left i.dd1 {
        animation: ani1 .25s infinite;
    }

    .guideW .data .right i.dd5 {
        animation: ani5 .25s infinite;
    }

    .guideW .data .right i.dd4 {
        animation: ani4 .25s infinite;
    }

    .guideW .data .right i.dd3 {
        animation: ani3 .25s infinite;
    }

    .guideW .data .right i.dd2 {
        animation: ani2 .25s infinite;
    }

    .guideW .data .right i.dd1 {
        animation: ani1 .25s infinite;
    }
</style>
<script>
    var autoTime;
    function addNumber(n){
        clearTimeout(autoTime);
        var t = parseInt($(".data .text").text());
        var j = (parseInt(n)-t)/10;
        for (var i=1;i<11;i++){
            addText(i,Math.ceil(j*i)+t);
        };
        //加载完成
        if(n==100){
            setTimeout(function () {
                $(".guideW").fadeOut(200);
                $(".h_ban .pic").addClass("on")
            },1600);
        };
    };
    function addText(i,j){
        autoTime=setTimeout(function () {
            $(".data .text").text(j);
        }, i*100);
    };
    //模拟百分比加载进度
    document.onreadystatechange = completeLoading;
    function completeLoading() {
        if(document.readyState=="uninitialized"){
            addNumber(10);
        }else if(document.readyState=="loading"){
            addNumber(25);
        }else if(document.readyState=="interactive"){
            addNumber(50);
        }else if(document.readyState=="complete"){
            addNumber(100);
        };
    };
</script>