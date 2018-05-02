<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\MOdel\url;
use App\Http\Requests\url as verify;
use LaravelChen\MyFlash\MyFlash;

class LinkController extends Controller
{
    //链接列表
    public function index(Request $request,url $url)
    {
        $list = $url->orderBy('sort', 'desc')->orderBy('id', 'desc')->paginate(20);
        return view('Admin.link.index')
              ->with('list',$list);
    }

    //添加链接页面
    public function create(Request $request)
    {
        return view('Admin.link.create');
    }

    //添加链接
    public function store(verify $request, url $url)
    {
        $add['title'] = $request->title;
        $add['url'] = $request->url;
        $add['sort'] = $request->sort;
        $add['remark'] = $request->remark;
        $add['state'] = $request->state;
        $data = $url->insertGetId($add);
        if ($data){
            myflash()->success('新加栏目成功');
            return redirect('admin/link/index');
        }else{
            myflash()->error('新加栏目失败');
            return redirect()->back();
        }
    }
    //修改栏目页面
    public function alter(Request $request, url $url, $id)
    {
        $data = $url->where([['id', $id]])->first();
        return view('Admin.link.alter')
            ->with('data', $data);
    }

    //修改栏目
    public function amend(verify $request, url $url)
    {
        $add['title'] = $request->title;
        $add['url'] = $request->url;
        $add['sort'] = $request->sort;
        $add['remark'] = $request->remark;
        $add['state'] = $request->state;
        $data = $url->where([['id',$request->id]])->update($add);
        if ($data){
            myflash()->success('修改栏目成功');
            return redirect('admin/link/index');
        }else{
            myflash()->error('修改栏目失败');
            return redirect()->back();
        }
    }
    //栏目的显示与隐藏
    public function state(Request $request,url $url){
        if ($request->isMethod('post')) {
            $u_id=$request->u_id;
            $show=$request->show;
            $url->where([['id',$u_id]])->update(['state'=>$show]);
        }
    }
    //更改栏目排序
    public function sort(Request $request,url $url){
        if ($request->isMethod('post')) {
            $u_id=$request->id;
            $sort=$request->sort;
            $url->where([['id',$u_id]])->update(['sort'=>$sort]);
        }
    }
    //删除栏目
    public function delect(Request $request,url $url, $u_id)
    {
        MyFlash::success('删除成功');
        $delect = $url->where([['id',$u_id]])->delete();
        if ($delect){
            myflash()->success('删除成功');
        }else{
            myflash()->error('删除失败');
        }
        //myflash()->success('想什么呢要在数据库删除');
        return redirect()->back();
    }
}
