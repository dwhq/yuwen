<?php

namespace App\Http\Middleware;

use App\Model\admin;
use App\Model\manage;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //没有登陆跳转到404页面
        //echo session('name');exit();
        //Laravel 的中间件里是不能直接返回视图的，要使用 response 的 view 方法反回。
        $admin_id = session('admin_id');
        if ($admin_id) {
            //获取当前的url  去掉参数的url
            $string = $request->route()->uri();//获取原生的url
            $url = preg_replace('/\/\{[\s\S]*\}/', '', $string);//去除url里面的参数选项
            $auth = self::auth($url, $admin_id);//判断访问的url是否有权限访问
            if ($auth) {
                return $next($request);
            } else {
                myflash()->error('您没有权限');
                $url = manage::defaultUrl($admin_id);
                //跳转到默认的控制器
                if ($url == ''){
                    return redirect('/');
                }
                return redirect($url);
            }
        } else {
            return response()->view('404');
        }
    }

    /**
     * @param $auth_url
     * @param $admin_id
     * @return bool
     * 判断访问的url 有没有权限
     */
    private static function auth($auth_url, $admin_id)
    {
        //公用模块

        $auth = DB::table('auth_list')->where([['url', $auth_url], ['status', 1]])->exists();
        if ($auth) {
            return true;
        }
        //id为1的账号为最高权限 拥有所有功能
        if ($admin_id != 1) {
            $admin_users = admin::admin_info($admin_id, ['auth_group_id'], 'id');
            $group_list = explode(',', $admin_users->auth_group_id);
            foreach ($group_list as $vo) {
                $data[] = DB::table('auth_group')->where([['id', $vo], ['status', 1]])->value('rulers');
            }
            $url = implode(',', $data);//拼接成字符串
            $url_list = array_unique(explode(',', $url));//转换成数组并去除重复值
            $auth_list = DB::table('auth_list')->where([['url', $auth_url], ['status', 1]])->whereIn('id', $url_list)->exists();
            if ($auth_list) {
                return true;
            } else {
                return false;
            }
        }
        return true;
    }
}
