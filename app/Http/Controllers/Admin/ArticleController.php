<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\store;
use App\Model\article;
use App\Model\column;

class ArticleController extends Controller
{
    //文章列表
    public function list(Request $request,article $article){
        $list = $article->select('id','title','desc','cateid','time','state')->orderBy('id','desc')->paginate(20);
        return view('Admin.article.list',['list' => $list]);
    }
    //添加文章
    public function create(Request $request,column $column){
        //显示页面
        $list=$column->where([['state',1]])->get();
        return view('Admin.article.create')
            ->with('list',$list);
    }
    public function store(store $request,article $article){
        //添加文章
    }
}
