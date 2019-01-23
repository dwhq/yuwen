<?php

namespace App\Http\Controllers\Admin;

use App\Model\manage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    public function index(){
        return view('Admin.index');
    }
    //发送邮件
    public function email(){
        $contents = request('contents');
        Mail::raw($contents, function ($message) {
            $email = request('email');
            $title = request('title');
            $message->to($email)->subject($title);
        });
        $data['info'] = '发送成功';
        $data['status'] = 1;
       $data['url'] = url('admin/email_show');
        return $data;
    }
    public function dine_email()
    {
        $list = ['1581176417@qq.com','309616507@qq.com'];
        $dine = ['木桶饭','刀削面','饸络','烤肉饭','驴蹄子','剁椒面','酸辣粉','饺子'];
        $name = array_rand($dine,1);
        $contents = '今天吃'.$dine[$name];
        foreach ($list as $vo){
            Mail::raw($contents, function ($message) use ($vo) {
                $email = $vo;
                $title = '午饭';
                $message->to($email)->subject($title);
            });
        }
        $data['info'] = '发送成功';
        $data['status'] = 1;
        return $data;
    }
    public function email_show(){
        return view('Admin.function.email_show');
    }

}
