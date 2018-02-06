<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\store;
use App\Model\article;
use App\Model\column;
use App\Model\tag;
use App\Http\Controllers\Home\PublicControllerr;
use App\Http\Controllers\Home\ArticleController as Articles;
use LaravelChen\MyFlash\MyFlash;

class ArticleController extends Controller
{
    //文章列表
    public function list(Request $request, article $article)
    {
        $list = $article->select('id', 'title', 'desc', 'cateid', 'time', 'state')->orderBy('id', 'desc')->paginate(20);
        return view('Admin.article.list', ['list' => $list]);
    }

    //添加文章页面
    public function create(Request $request, column $column)
    {
        //显示页面
        $list = $column->where([['state', 1]])->get();
        return view('Admin.article.create')
            ->with('list', $list);
    }

    //添加文章
    public function store(store $request, article $article, tag $tag)
    {

        $add['title'] = $request->title;
        $add['desc'] = $request->desc;
        $add['pic'] = $request->image;
        $add['cateid'] = $request->cateid;
        $add['state'] = $request->state;
        $add['account'] = $request->account;
        $add['time'] = time();
        if ($add['desc'] == '') {
            $add['desc'] = str_limit($add['account'], 50);
        }
        $label = $request->tags;
        $data = $article->insertGetId($add);
        if ($data) {
            //插入文章后写入文章的标签
            if ($request->tags != '') {
                $tag->write($data, $label);
            }
            myflash()->success('插入文章成功');
            return redirect('admin/article/list');
        }
        myflash()->error('插入文章失败!');
        return redirect('admin/article/create');
    }

    //后台查看文章
    public function look(Request $request, Articles $articleController, article $article, $u_id)
    {
        $content = $article->where([['id', $u_id]])->first();
        $public = new PublicControllerr();
        $colum = $public->column();
        $info = $public->info();
        $tag = $public->tag();
        $url = $public->url();
        $new_article = $public->new_article();
        //引入标签和上下文
        $article_tag = $articleController->article_tag($u_id);
        $up_article = $articleController->up_article($u_id);
        $next_article = $articleController->next_article($u_id);
        $type = $content->cateid;
        return view('Home/content')
            ->with('info', $info)
            ->with('colum', $colum)
            ->with('type', $type)
            ->with('tag', $tag)
            ->with('content', $content)
            ->with('up_article', $up_article)
            ->with('next_article', $next_article)
            ->with('article_tag', $article_tag)
            ->with('url', $url)
            ->with('new_article', $new_article);
    }

    //删除文章
    public function delect(Request $request, article $article, $u_id)
    {
//        MyFlash::success('删除成功');
//        $delect = $article->where([['id',$u_id]])->delete();
//        if ($delect){
//            myflash()->success('删除成功');
//        }else{
//            myflash()->error('删除失败');
//        }
           myflash()->success('想什么呢要在数据库删除');
        return redirect()->back();
    }

    //修改文章页面
    public function alter(Request $request, Articles $articleController, column $column, article $article, $u_id)
    {
        $data = $article->where([['id', $u_id]])->first();
        $article_tag = $articleController->article_tag($u_id);
        $article_tag = collect($article_tag);
        $list = $column->where([['state', 1]])->get();
        //把数组类型的标签转换城字符串
        $tags = $article_tag->pluck('name')->implode(',');
        return view('admin.article.alter')
            ->with('data', $data)
            ->with('list', $list)
            ->with('tags', $tags);
    }

    //修改文章
    public function amend(store $request, article $article, tag $tag)
    {
        $id = $request->id;
        $add['title'] = $request->title;
        $add['desc'] = $request->desc;
        $add['pic'] = $request->image;
        $add['cateid'] = $request->cateid;
        $add['state'] = $request->state;
        $add['account'] = $request->account;
        $add['time'] = time();
        if ($add['desc'] == '') {
            $add['desc'] = str_limit($add['account'], 50);
        }
        $label = $request->tags;
        $data = $article->where([['id', $id]])->update($add);
        if ($data) {
            //插入文章后写入文章的标签
            if ($request->tags != '') {
                $tag->write($data, $label);
            }
            myflash()->success('修改文章成功');
            return redirect('admin/article/list');
        }
        myflash()->error('修改文章失败!');
        return redirect('admin/article/alter/' . $id);
    }
}
