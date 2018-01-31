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

            return '验证码错误';
        }
        return '验证码正确';
        pd($request->all());exit();
        return view('Admin/login');
    }
}
