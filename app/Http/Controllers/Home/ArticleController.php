<?php

namespace App\Http\Controllers\Home;

use App\Model\article;
use App\Model\user;
use App\Model\word;
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
        $user_info = user::user_info(session('user_id'),'id',['id','account','avatar','nickname']);
        $tag = $this->tag();
        $url = $this->url();
        $title='';
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
            ->with('user_info', $user_info)
            ->with('title',$title)
            ->with('new_article',$new_article)
            ->with('page',$page);
    }
    public function home(Request $request,$type)
    {
        $colum = $this->column();
        $info = $this->info();
        $tag = $this->tag();
        $url = $this->url();
        $title='';
        $user_info = user::user_info(session('user_id'),'id',['id','account','avatar','nickname']);
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
            ->with('title',$title)
            ->with('user_info',$user_info)
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
        $word = word::inquire($id);//文章留言信息
        $content=DB::table('article')->where([['id',$id],['state',1]])->first();
        if (!$content){
            return view('404');
        }
        $user_info = user::user_info(session('user_id'),'id',['id','account','avatar','nickname']);
        $colum = $this->column();
        $info = $this->info();
        $tag = $this->tag();
        $url = $this->url();
        $new_article = $this->new_article();
        $article_tag=$this->article_tag($id);
        $up_article=$this->up_article($id);
        $next_article=$this->next_article($id);
        $type = $content->cateid;
        return view('Home/content')
            ->with('info',$info)
            ->with('colum',$colum)
            ->with('type',$type)
            ->with('tag',$tag)
            ->with('word',$word)
            ->with('user_info',$user_info)
            ->with('content',$content)
            ->with('up_article',$up_article)
            ->with('next_article',$next_article)
            ->with('article_tag',$article_tag)
            ->with('url',$url)
            ->with('new_article',$new_article);
    }

    /**
     * 一个文章的所有标签
     */
    public function article_tag($id){
        $data = DB::table('tags')->where([['tags.u_id',$id]])->leftjoin('tag','tag.id','=','tags.tag_id')->select('tag.id','tag.name')->get();
        return $data;
    }

    /**
     * @param $id
     * @return bool
     * 上一篇
     */
    public function up_article($id){
        $data = DB::table('article')->select('title','id')->where([['state',1],['id','<',$id]])->orderBy('id','desc')->limit(1)->first();
        return $data;
    }

    /**
     * @param $id
     * @return bool
     * 下一篇
     */
    public function next_article($id){
        $data = DB::table('article')->select('title','id')->where([['state',1],['id','>',$id]])->orderBy('id','asc')->limit(1)->first();
        return $data;
    }

    /**
     * 根据标签查文章
     */
    public function label(Request $request,$tag_id){
        $colum = $this->column();
        $info = $this->info();
        $tag = $this->tag();
        $url = $this->url();
        $user_info = user::user_info(session('user_id'),'id',['id','account','avatar','nickname']);
        $new_article = $this->new_article();
        $list = DB::table('tags')->select('tag.name','article.back','article.title','article.pic','article.id','article.desc','article.cateid','article.time')->where([['article.state',1],['tag.id',$tag_id]])->leftjoin('tag','tag.id','=','tags.tag_id')->leftjoin('article','article.id','=','tags.u_id')->orderBy('article.id','sort')->paginate(10);
        if ($list->isEmpty()){
            return view('404');
        }
        if (!$list[0]->name){
            return view('404');
        }
        $page = $list->links();//分页的
        $title='<div class="h4">拥有标签'.$list[0]->name.'的文章</div>';//显示的文字
        $type='';
        return view('Home/index')
            ->with('list',$list)
            ->with('info',$info)
            ->with('colum',$colum)
            ->with('type',$type)
            ->with('tag',$tag)
            ->with('user_info',$user_info)
            ->with('title',$title)
            ->with('url',$url)
            ->with('new_article',$new_article)
            ->with('page',$page);
    }

    /**
     * @param Request $request
     * @param article $article
     * @return mixed
     * 文章搜索
     */
    public function search(Request $request,article $article)
    {
        //
        $colum = $this->column();
        $info = $this->info();
        $tag = $this->tag();
        $user_info = user::user_info(session('user_id'),'id',['id','account','avatar','nickname']);
        $url = $this->url();
        $seek = $request->input('seek');
        $title='<div class="h4">关于'.$seek.'的搜索结果</div>';//显示的文字
        $new_article = $this->new_article();
        //$list = DB::table('article')->where([['state',1],['account','like','%'.$seek.'%']])->orwhere([['title','like','%'.$seek.'%']])->orderBy('id','sort')->paginate(10);
        $list = $article::search($seek)->orderBy('id','sort')->paginate(10);
        $page = $list->links();
        $type='';
        return view('Home/index')
            ->with('list',$list)
            ->with('info',$info)
            ->with('colum',$colum)
            ->with('type',$type)
            ->with('seek',$seek)
            ->with('user_info',$user_info)
            ->with('tag',$tag)
            ->with('url',$url)
            ->with('title',$title)
            ->with('new_article',$new_article)
            ->with('page',$page);
    }
}
