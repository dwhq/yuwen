<?php

namespace App\Http\Middleware;

use App\Model\admin;
use Closure;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //没有登陆跳转到404页面
        //echo session('name');exit();
        //Laravel 的中间件里是不能直接返回视图的，要使用 response 的 view 方法反回。
        $admin_id = session('admin_id');
        if ($admin_id){
            $auth = self::auth($request->path(),$admin_id);
            //session值对的话就继续执行
            if ($auth){
                return $next($request);
            }else{
                myflash()->error('您没有权限');
                return redirect('admin/info');
            }
        }else{
            return response()->view('404');
        }
    }
    private static function auth($auth_url,$admin_id){
        //id为1的账号为最高权限 拥有所有功能
        if ($admin_id != 1 && $auth_url!='admin/logOut'){
            $admin_users = admin::admin_info($admin_id,['auth_group_id'],'id');
            $group_list = explode(',',$admin_users->auth_group_id);
            foreach ($group_list as $vo ){
                $data[] = DB::table('auth_group')->where([['id',$vo],['status',1]])->value('rulers');
            }
            $url = implode(',',$data);//拼接成字符串
            $url_list = array_unique(explode(',',$url));//转换成数组并去除重复值
            $auth_list = DB::table('auth_list')->where([['url',$auth_url],['status',1]])->whereIn('id',$url_list)->exists();
            if (!$auth_list){
                return false;
            }
        }
        return true;
    }
}
