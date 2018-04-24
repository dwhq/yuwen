<?php

namespace App\Http\Controllers\Admin;

use App\Model\admin;
use Illuminate\Filesystem\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use LaravelChen\MyFlash\MyFlash;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function index(Request $request){
            $rules = [
                'captcha' => 'required|captcha'
            ];
            $validator = Validator::make($request->all(), $rules);
            $result = $this->validate($request, [
                'geetest_challenge' => 'geetest',
            ], [
                'geetest' => config('geetest.server_fail_alert')
            ]);
            if (!$request) {
                $data['info']='验证码错误';
                $data['state']='0';
                return $data;
            }
            $admin = admin::admin_info($request->name,['password']);
            if (Hash::check($request->password, $admin->password)){
                session(['name' => 'petrichor']);
                $data['info']='登陆成功';
                $data['state']='1';
                $data['url']=url('admin/index');
                return $data;
            }else{
                $data['info']='用户名或密码错误';
                $data['state']='2';
                return $data;
            }
    }
    //后台退出登录
    public function logOut(Request $request){
        $request->session()->forget('name');
        myflash()->success('退出登陆');
        return redirect('/');

    }
    //清楚缓存
    public function clearCache(){
        Artisan::call('cache:clear');
        Artisan::call('config:clear');
        Artisan::call('route:clear');
        Artisan::call('view:clear');
        Artisan::call('clear-compiled');
        myflash()->success('清除缓存成功');
        return redirect()->back();
    }
}
