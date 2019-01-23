<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\url;
use App\Model\user;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\store;
use App\Model\article;
use App\Model\column;
use App\Model\tag;
use App\Http\Controllers\Home\PublicControllerr;
use App\Http\Controllers\Home\ArticleController as Articles;
use App\Model\mood;
use LaravelChen\MyFlash\MyFlash;
use App\Model\word;
use NoisyWinds\Smartmd\Markdown;

class ArticleController extends Controller
{
    //文章列表
    public function list(Request $request, article $article)
    {

        $list = $article->select('id', 'title', 'desc', 'cateid', 'time', 'state')->orderBy('id', 'desc')->paginate(20);
        if ($request->isMethod('post')) {
            $seek = $request->seek;
            $list = $article::search($seek)->orderBy('id', 'desc')->paginate(20);
        }
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
        $add['back'] = 2;
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
        $word = word::inquire($u_id);//文章留言信息
        $public = new PublicControllerr();
        $colum = $public->column();
        $user_info = 'admin';
        $info = $public->info();
        $tag = $public->tag();
        $url = $public->url();
        $new_article = $public->new_article();
        //引入标签和上下文
        $article_tag = $articleController->article_tag($u_id);
        $up_article = $articleController->up_article($u_id);
        $next_article = $articleController->next_article($u_id);
        $type = $content->cateid;
        if ($content->id > 100) {
            $parse = new Markdown();
            $content->account = $parse->text($content->account);
        }
        return view('Home1/content')
            ->with('info', $info[0])
            ->with('colum', $colum)
            ->with('type', $type)
            ->with('tag', $tag)
            ->with('word', $word)
            ->with('user_info', $user_info)
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
        MyFlash::success('删除成功');
        $delect = $article->where([['id', $u_id]])->delete();
        if ($delect) {
            myflash()->success('删除成功');
        } else {
            myflash()->error('删除失败');
        }
//           myflash()->success('想什么呢要在数据库删除');
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
        return view('Admin.article.alter')
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

    //文章的显示与隐藏
    public function state(Request $request, article $article)
    {
        if ($request->isMethod('post')) {
            $u_id = $request->u_id;
            $show = $request->show;
            $article->where([['id', $u_id]])->update(['state' => $show]);
        }
    }

    /**
     * @param mood $mood
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * 时间轴列表
     */
    public function mood_list(mood $mood)
    {
        $list = $mood->orderBy('id', 'desc')->paginate(20);
        return view('Admin.article.mood_list', ['list' => $list]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\Views
     * 时间轴添加页面
     */
    public function mood_show()
    {
        return view('Admin.article.mood_show');
    }

    /**
     * @param Request $request
     * @param mood $mood
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 添加时间轴
     */
    public function mood_add(Request $request)
    {
        $data['title'] = $request->title;
        $data['content'] = $request->contents;
        $data['state'] = $request->state;
        $mood = new mood();
        $add = $mood->add($data);
        if ($add) {
            $data['info'] = '插入成功';
            $data['status'] = 1;
            $data['url'] = url('admin/article/mood_list');
        } else {
            $data['info'] = '插入失败';
            $data['status'] = 0;
        }
        return $data;
    }

    //文章的显示与隐藏
    public function mood_state(Request $request, mood $mood)
    {
        if ($request->isMethod('post')) {
            $u_id = $request->u_id;
            $show = $request->show;
            $data = $mood->where([['id', $u_id]])->update(['state' => $show]);
            pd($data);
            exit();
        }
    }
}
