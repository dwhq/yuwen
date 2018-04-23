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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;

class DemoController extends Controller{

    public function demo(Request $request){
        if ($request->isMethod('post')){
            $id = $request->id;
            echo $id;
            $data = DB::table('users')->where([['id','=',$id]])->get();
            //$data = DB::table('users')->whereRaw("id = '$id'")->get();
            $sql = DB::table('users')->where([['id',$id]])->toSql();
            echo $sql;
            pd($data);
        }else{
            return view('Home.demo');
        }
    }
    public function demo23()
    {
        Redis::set('name', 'Taylor');
        $user = Redis::get('name');
        pd($user);
        $values = Redis::lrange('names', 5, 10);
    }
}