<?php

namespace App\Http\Controllers\Tool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Zxing\QrReader;
class qrCodeController extends Controller
{
    //
    public function show(){
        $qrcode = new QrReader('./timg.jpg');
        $text = $qrcode->text(); //return decoded text from QR Code
        var_dump($text);
//        return 111;
    }
}
