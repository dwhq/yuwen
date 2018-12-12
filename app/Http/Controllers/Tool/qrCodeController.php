<?php

namespace App\Http\Controllers\Tool;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Zxing\QrReader;

class qrCodeController extends Controller
{
    //
    public function show(){
//        $qrcode = new QrReader('/timg.jpg');
//        echo '<img src="/timg.jpg" alt="">';
//        QrCode::generate('Make me into a QrCode!');
       $a =  QrCode::format('png')->size(200)->encoding('UTF-8')->generate('识别二维码',public_path('phpqrcode.png'));
//       echo '<img src="'.$a.'">';
        //识别二维码
        $qrcode = new QrReader(public_path('phpqrcode.png'));
        return$qrcode->text();
//        $text = $qrcode->text(); //return decoded text from QR Code
//        var_dump($text);
//        return 111;
    }
}
