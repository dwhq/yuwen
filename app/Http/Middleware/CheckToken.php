<?php

namespace App\Http\Middleware;

use Closure;
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
        if (session('name') == 'petrichor'){
            self::auth($request->path(),$admin_id);
            //session值对的话就继续执行
            return $next($request);
        }else{
            return response()->view('404');
        }
    }
    private static function auth($admin_id,$usr){

    }
}
