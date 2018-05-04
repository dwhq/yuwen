<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2018/4/19
 * Time: 11:18
 */
namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class DemoController extends Controller{

    public function demo(Request $request){
        pd(self::getIp());
//        if ($request->isMethod('post')){
//            $id = $request->id;
//            echo $id;
//            $data = DB::table('users')->where([['id','=',$id]])->get();
//            //$data = DB::table('users')->whereRaw("id = '$id'")->get();
//            $sql = DB::table('users')->where([['id',$id]])->toSql();
//            echo $sql;
//            pd($data);
//        }else{
//            return view('Home.demo');
//        }
    }
    public function demo23()
    {
        Redis::set('name', 'Taylor');
        $user = Redis::get('name');
        pd($user);
        $values = Redis::lrange('names', 5, 10);
    }
    public static function getClientIp(){
        if (isset($_SERVER))
        {
            if (isset($_SERVER[HTTP_X_FORWARDED_FOR]) && strcasecmp($_SERVER[HTTP_X_FORWARDED_FOR], "unknown"))//代理
            {
                $realip = $_SERVER[HTTP_X_FORWARDED_FOR];
            }
            elseif(isset($_SERVER[HTTP_CLIENT_IP]) && strcasecmp($_SERVER[HTTP_CLIENT_IP], "unknown"))
            {
                $realip = $_SERVER[HTTP_CLIENT_IP];
            }
            elseif(isset($_SERVER[REMOTE_ADDR]) && strcasecmp($_SERVER[REMOTE_ADDR], "unknown"))
            {
                $realip = $_SERVER[REMOTE_ADDR];
            }
            else
            {
                $realip = 'unknown';
            }
        }
        else
        {
            if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
            {
                $realip = getenv("HTTP_X_FORWARDED_FOR");
            }
            elseif(getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"), "unknown"))
            {
                $realip = getenv("HTTP_CLIENT_IP");
            }
            elseif(getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
            {
                $realip = getenv("REMOTE_ADDR");
            }
            else
            {
                $realip = 'unknown';
            }
        }
        return $realip;
    }
    public function fangwen(){
        if(!empty($_COOKIE["access"]) && $_COOKIE["access"]==1){
            if(file_exists("count.txt")){
                $one_file=fopen("count.txt","w+");
                echo"您是第<font color='red'><b>1</b></font>位访客";
                fwrite("count.txt","1");
                fclose("$one_file");
                setcookie("access",1, time()+3600*24); //访问过标记
            }
        }else{
            $num=file_get_contents("count.txt");
            $num++;
            file_put_contents("count.txt","$num");
            $newnum=file_get_contents("count.txt");
            echo"您是第<font color='red'><b>".$newnum."</b></font>位访客";
            setcookie("access",1, time()+3600*24);//访问过标记
        }
    }
    public static function getIp()
    {
        $ip=false;
        if(!empty($_SERVER["HTTP_CLIENT_IP"])){
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        }
        if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ips = explode (", ", $_SERVER['HTTP_X_FORWARDED_FOR']);
            if ($ip) { array_unshift($ips, $ip); $ip = FALSE; }
            for ($i = 0; $i < count($ips); $i++) {
                if (!eregi ("^(10│172.16│192.168).", $ips[$i])) {
                    $ip = $ips[$i];
                    break;
                }
            }
        }
        return ($ip ? $ip : $_SERVER['REMOTE_ADDR']);
    }
}