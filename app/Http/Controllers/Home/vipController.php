<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class vipController extends Controller
{
    /**
     * @param Request $request
     * @param $tag_id
     * @return \Illuminate\Http\RedirectResponse
     * 退出登录
     */
    public function logout(Request $request,$tag_id)
    {
        $request->session()->forget('user_id');
        return redirect()->back();
    }
    public function comment(Request $request){
        $add['contents'] = $request->contents;
        $add['email'] = $request->email;
        $add['u_id'] = $request->u_id;
        $add['type'] = $request->type;
        $add['word_id'] = $request->word_id;
        $data['info'] = '插入失败';

        $data['status'] = 0;
        return $data;
    }
}
