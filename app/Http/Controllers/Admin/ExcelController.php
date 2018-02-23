<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Excel;
use QrCode;
use QrReader;

class ExcelController extends Controller
{
    //
    //Excel文件导出功能 By Laravel学院
    public function export(){
       //QrCode::format('png')->generate('Make me into a QrCode!', '../public/qrcode.png');exit();//生成二维码e
        //生成二维码并嵌入图片
       //echo QrCode::encoding('UTF-8')->format('png')->merge('../public/123.png', .3)->size(1000)->generate('这只是一个二维码','../public/147258.png');exit();
        $qrcode = new QrReader('../public/qrcode.png');//解析二维码
        echo $qrcode->text();exit();

        // 输出
        echo $text;die;
        $data = array(
            array('data1', 'data2'),
            array('data3', 'data4')
        );


        Excel::create('学生成绩1', function($excel) use($data) {

            $excel->sheet('学生成绩2', function($sheet) use($data) {

                $sheet->rows($data);

            });
        })->export('xls');

//        Excel::create('学生成绩',function($excel) use ($cellData){
//            $excel->sheet('score', function($sheet) use ($cellData){
//                $sheet->rows($cellData);
//            });
//        })->export('csv');
    }
}
