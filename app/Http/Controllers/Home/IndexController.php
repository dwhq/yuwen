<?php

namespace App\Http\Controllers\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
//use SimpleSoftwareIO\QrCode\Facades\QrCode;

class IndexController extends Controller
{
    //
    public function column()
    {
        //栏目查询
        $data=DB::table('column')->select('id','name','type','sort')->where([['state',1],['time','>','0']])->orderBy('sort','desc')->get();
        return $data;
    }
    public function info(){
        $data = DB::table('info')->orderBy('id','desc')->limit(1)->get();
        return $data;
    }
//    public function qrcode(){
//        QrCode::generate('Hello,LaravelAcademy!');
//    }
}
