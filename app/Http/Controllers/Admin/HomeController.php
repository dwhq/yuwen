<?php

namespace App\Http\Controllers\Admin;

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
    public function email_show(){
        return view('Admin.function.email_show');
    }

}
