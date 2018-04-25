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
use LaravelChen\MyFlash\MyFlash;
use App\Model\admin;

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
    public function add_admin(Request $request,admin $admin){
        if ($request->isMethod('post')){
            $auth_group_id = '';
            $data['name'] = $request->name;
            $data['password'] = $request->password;
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
            return view('Admin.manage.add_admin');
        }
    }
}