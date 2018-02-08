<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\column;
use App\Http\Requests\column as verify;
use LaravelChen\MyFlash\MyFlash;

class ColumnController extends Controller
{
//栏目列表
    public function index(Request $request, column $column)
    {
        $list = $column->orderBy('sort', 'desc')->orderBy('id', 'desc')->paginate(20);
        return view('Admin.column.index')
            ->with('list',$list);
    }

    //添加栏目页面
    public function create(Request $request)
    {
        return view('Admin.column.create');
    }

    //添加栏目
    public function store(verify $request, column $column)
    {
        $add['name'] = $request->name;
        $add['type'] = $request->type;
        $add['sort'] = $request->sort;
        $add['state'] = $request->state;
        $add['time'] = time();
        $data = $column->insertGetId($add);
        if ($data){
            myflash()->success('新加栏目成功');
            return redirect('admin/column/index');
        }else{
            myflash()->error('新加栏目失败');
            return redirect()->back();
        }
    }
    //修改栏目页面
    public function alter(Request $request, column $column, $id)
    {
        $data = $column->where([['id', $id]])->first();
        return view('admin.column.alter')
            ->with('data', $data);
    }

    //修改栏目
    public function amend(verify $request, column $column)
    {
        $add['name'] = $request->name;
        $add['type'] = $request->type;
        $add['sort'] = $request->sort;
        $add['state'] = $request->state;
        $add['time'] = time();
        $data = $column->where([['id',$request->id]])->update($add);
        if ($data){
            myflash()->success('修改栏目成功');
            return redirect('admin/column/index');
        }else{
            myflash()->error('修改栏目失败');
            return redirect()->back();
        }
    }
    //栏目的显示与隐藏
    public function state(Request $request,column $column){
        if ($request->isMethod('post')) {
            $u_id=$request->u_id;
            $show=$request->show;
            $column->where([['id',$u_id]])->update(['state'=>$show]);
        }
    }
    //更改栏目排序
    public function sort(Request $request,column $column){
        if ($request->isMethod('post')) {
            $u_id=$request->id;
            $sort=$request->sort;
            $column->where([['id',$u_id]])->update(['sort'=>$sort]);
        }
    }
    //删除栏目
    public function delect(Request $request,column $column, $u_id)
    {
        MyFlash::success('删除成功');
        $delect = $column->where([['id',$u_id]])->delete();
        if ($delect){
            myflash()->success('删除成功');
        }else{
            myflash()->error('删除失败');
        }
        //myflash()->success('想什么呢要在数据库删除');
        return redirect()->back();
    }
}
