<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $colum = $this->column();
        $info = $this->info();
        $tag = $this->tag();
        $url = $this->url();
        $new_article = $this->new_article();
        $list = DB::table('article')->where([['state',1]])->orderBy('id','sort')->paginate(10);
        $page = $list->links();
        $type='';
        return view('Home/index')
            ->with('list',$list)
            ->with('info',$info)
            ->with('colum',$colum)
            ->with('type',$type)
            ->with('tag',$tag)
            ->with('url',$url)
            ->with('new_article',$new_article)
            ->with('page',$page);
    }
    public function home(Request $request,$type)
    {
        $colum = $this->column();
        $info = $this->info();
        $tag = $this->tag();
        $url = $this->url();
        $new_article = $this->new_article();
        $data=DB::table('column')->where([['type',$type],['state',1]])->value('type');
        //栏目不存在报错
        if (!$data){
            return view('404');
        }
        $list = DB::table('article')->where([['state',1],['cateid',$type]])->orderBy('id','desc')->paginate(10);
        $page = $list->links();
        return view('Home/index')
            ->with('list',$list)
            ->with('info',$info)
            ->with('colum',$colum)
            ->with('type',$type)
            ->with('tag',$tag)
            ->with('url',$url)
            ->with('new_article',$new_article)
            ->with('page',$page);
    }

    /**
     * @return mixed
     * 查询栏目
     */
    private function column()
    {
        //栏目查询
        $data=DB::table('column')->select('id','name','type','sort')->where([['state',1],['time','>','0']])->orderBy('sort','desc')->get();
        return $data;
    }
    //网站信息
    private function info(){
        $data = DB::table('info')->orderBy('id','desc')->limit(1)->get();
        return $data;
    }
    //最新文章
    private function new_article(){
        $data = DB::table('article')->where([['state',1]])->orderBy('id','desc')->limit(5)->get();
        return $data;
    }
    //标签
    private function tag(){
        $tag = DB::table('tag')->limit(30)->get();
        return $tag;
    }
    //友情链接
    private function url(){
        $url = DB::table('url')->where([['state',1]])->orderBy('sort','desc')->orderBy('id','desc')->limit(20)->get();
        return $url;
    }
    //文章内容
    public function content(Request $request,$id){
        $colum = $this->column();
        $info = $this->info();
        $tag = $this->tag();
        $url = $this->url();
        $new_article = $this->new_article();
        $content=DB::table('article')->where([['id',$id]])->first();
        $type = $content->cateid;
        return view('Home/content')
            ->with('info',$info)
            ->with('colum',$colum)
            ->with('type',$type)
            ->with('tag',$tag)
            ->with('content',$content)
            ->with('url',$url)
            ->with('new_article',$new_article);
    }
}
