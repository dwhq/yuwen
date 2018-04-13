<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\word;

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

    /**
     * @param Request $request
     * @param word $word
     * @return mixed
     * 评论文章
     */
    public function comment(Request $request,word $word){
        $add['contents'] = $request->contents;
        $add['email'] = $request->email;
        $add['u_id'] = $request->u_id;
        $add['type'] = $request->type;
        if (strlen($add['contents']) < 15){
            $data['info'] = '多写点！！';
            $data['status'] = 0;
        }else{
            $words = $word->insertGetId($add);
            if ($words){
                $data['info'] = '评论成功！！';
                $data['status'] = 1;
            }else{
                $data['info'] = '评论失败未知错误！！';
                $data['status'] = 0;
            }
        }
        return $data;
    }
}
