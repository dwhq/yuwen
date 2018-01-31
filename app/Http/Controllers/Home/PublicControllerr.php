<?php
/**
 * 公共数据
 */

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PublicControllerr extends Controller
{
    //
    /**
     * @return mixed
     * 查询栏目
     */
    public function column()
    {
        //栏目查询
        $data=DB::table('column')->select('id','name','type','sort')->where([['state',1],['time','>','0']])->orderBy('sort','desc')->get();
        return $data;
    }
    //网站信息
    public function info(){
        $data = DB::table('info')->orderBy('id','desc')->limit(1)->get();
        return $data;
    }
    //最新文章
    public function new_article(){
        $data = DB::table('article')->where([['state',1]])->orderBy('id','desc')->limit(5)->get();
        return $data;
    }
    //标签
    public function tag(){
        $tag = DB::table('tag')->limit(30)->get();
        return $tag;
    }
    //友情链接
    public function url(){
        $url = DB::table('url')->where([['state',1]])->orderBy('sort','desc')->orderBy('id','desc')->limit(20)->get();
        return $url;
    }
}
