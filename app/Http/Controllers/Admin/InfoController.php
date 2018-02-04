<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\info;


class InfoController extends Controller
{
    //查询网站信息
    public function index(Request $request){
        $info=new info();
        $data=$info->orderBy('id','desc')->first();
        return view('Admin.info')
            ->with('list',$data);
    }
    //编辑网站信息 直接插入新的数据不更新
    public function Store(StoreBlogPost $request){
        $info=new info();
        $data=$info->insertGetId(['name'=>$request->name,'image'=>$request->image,'qq'=>$request->qq,'email'=>$request->email,'mobile'=>$request->mobile,'bottom_info'=>$request->bottom_info]);
        return redirect('admin/info');
    }
}
