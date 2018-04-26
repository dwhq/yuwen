<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2018/4/25
 * Time: 15:04
 */
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use LaravelChen\MyFlash\MyFlash;
use App\Model\admin;
use Illuminate\Support\Facades\DB;

class manageController extends Controller
{

    public function admin_list(Request $request,admin $admin){
        $data = $admin->where([['status',1]])->select('id','name','sex','email','mobile','time')->paginate(20);
        $name =  '';
        if ($request->isMethod('post')){
            $data = $admin->where([['status',1],['name','LIKE',$request->name]])->select('id','name','sex','email','mobile','time')->paginate(20);
            $name = $request->name;
        }
        return view('Admin.manage.admin_list')
            ->with('data',$data)
            ->with('name',$name);
    }

    /**
     * @param admin $admin
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * 删出管理员  软删除
     */
    public function delect(admin $admin,$id){
        $data =  $admin->where([['id',$id]])->update(['status'=>0]);
        if ($data){
            myflash()->success('删除成功');
        }else{
            myflash()->error('删除失败');
        }
        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param admin $admin
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 添加管理员
     */
    public function add_admin(Request $request,admin $admin){
        if ($request->isMethod('post')){
            $auth_group_id = implode(',',$request->grout);
            $data['name'] = $request->name;
            $data['password'] =Hash::make($request->password);
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['sex'] = $request->sex;
            $data['time'] = time();
            $data['last_ip'] = $request->ip();
            $data['status'] = 1;
            $data['auth_group_id'] = $auth_group_id;
            $admins = $admin->create($data);
            if ($admins){
                myflash()->success('添加成功');
                return redirect('admin/manage/admin_list');
            }else{
                myflash()->error('添加失败');
                return redirect()->back();
            }
        }else{
            //会员组列表
            $auth_group_list = DB::table('auth_group')->Where('status',1)->select('id','title')->get();
            return view('Admin.manage.add_admin')
                ->with('auth_group_list',$auth_group_list);
        }
    }

    /**
     * @param Request $request
     * @param admin $admin
     * @param $id
     * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * 修改管理员信息
     */
    public function revamped_admin(Request $request,admin $admin,$id){
        if ($request->isMethod('post')){
            $auth_group_id = implode(',',$request->grout);
            $data['name'] = $request->name;
            $data['email'] = $request->email;
            $data['mobile'] = $request->mobile;
            $data['sex'] = $request->sex;
            $data['auth_group_id'] = $auth_group_id;
            if ($request->password !='')$data['password'] =Hash::make($request->password);
            $admins = $admin->where('id',$id)->update($data);
            if ($admins){
                myflash()->success('修改成功');
                return redirect('admin/manage/admin_list');
            }else{
                myflash()->error('修改失败');
                return redirect()->back();
            }
        }else{
            $admin_info = admin::admin_info($id,['id','name','email','mobile','sex','auth_group_id'],'id');
            $admin_info->grout = explode(',',$admin_info->auth_group_id);//把用户组字段转换为数组  方便前台调用
            //DB::enableQueryLog();
            $auth_group_list = DB::table('auth_group')->Where('status',1)->select('id','title')->get();//会员组列表
            //dd(response() ->json(DB::getQueryLog())); //打印sql语句
            return view('Admin.manage.revamped_admin')
                ->with('admin_info',$admin_info)
                ->with('auth_group_list',$auth_group_list);
        }
    }

    /**
     * @param Request $request
     * @return $this
     * 模板列表
     */
    public function module_list(Request $request){
        $data = DB::table('auth_list')->where('father_id',0)->select('id','url','name','status','father_id')->get();
        foreach ($data as &$vo){
            $vo->level = DB::table('auth_list')->where('father_id',$vo->id)->select('id','url','name','status','father_id')->get();
        }
        return view('Admin.manage.module_list')
            ->with('data',$data);
    }
    public function add_url(Request $request,$id){
        if ($request->isMethod('post')){
            $data['url'] = $request->url;
            $data['name'] = $request->name;
            $data['status'] = $request->status;
            $data['father_id'] = $id;
            $auth_list = DB::table('auth_list')->insertGetId($data);
            if ($auth_list){
                myflash()->success('添加成功');
                return redirect('admin/manage/admin_list');
            }else{
                myflash()->error('添加失败');
                return redirect()->back();
            }
        }else{
            return view('Admin.manage.add_url')
                ->with('id',$id);
        }
    }
}