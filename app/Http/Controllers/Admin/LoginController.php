<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    //
    public function index(Request $request){
            $rules = [
                'captcha' => 'required|captcha'
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                $data['info']='验证码错误';
                $data['state']='0';
                return $data;
            }
            if ($request->name == '余温' && $request->password=='dwhq963.-+'){
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
}
