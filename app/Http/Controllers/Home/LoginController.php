<?php
namespace App\Http\Controllers\Home;

use Socialite;
use App\Http\Controllers\Controller;
use App\Model\user;

class LoginController extends Controller
{
    /**
     * 将用户重定向到Github认证页面
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * 从Github获取用户信息.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();
        $data['github_id'] = $user->id;
        $data['nickname'] = $user->nickname;
        $data['name'] = $user->name;
        $data['email'] = $user->email;
        $data['avatar'] = $user->avatar;
        $info = user::user_info($data['github_id'],'github_id');
        if (!$info){
            $id = user::add_user($data);
        }else{
         $id = $info->id;
        }
        session(['user_id' => $id]);
        myflash()->success('登录成功');
        return redirect()->back();
    }

    /**
     * @param $id
     * 会员登陆
     */
    public function register($id,$password){
        $info = user::user_info($id);
        if ($info){
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