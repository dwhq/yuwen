<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\article;

class ArticleController extends Controller
{
    //文章列表
    public function list(Request $request,article $article){
        $list = $article->select('id','title','desc','cateid','time','state')->orderBy('id','desc')->get();
        return view('Admin.article.list')
            ->with('list',$list);
    }
}
