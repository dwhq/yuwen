<?php

namespace App\Http\Controllers\Tool;

use App\services\OSS;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Zxing\QrReader;
use DateTime;

class qrCodeController extends Controller
{
    //
    public function show(){
//        $qrcode = new QrReader('/timg.jpg');
//        echo '<img src="/timg.jpg" alt="">';
//        QrCode::generate('Make me into a QrCode!');
        return QrCode::format('svg')->size(200)->encoding('UTF-8')->wiFi([
            'ssid' => 'tnts',
            'encryption' => 'WPA/WEP',
            'password' => 'qq123456789.'
        ]);
//        pd($a);
//        echo '<img src="'.$a.'">';
        //识别二维码
//        $qrcode = new QrReader(public_path('phpqrcode.png'));
//        return$qrcode->text();
//        $text = $qrcode->text(); //return decoded text from QR Code
//        var_dump($text);
//        return 111;
    }
    public function oss(OSS $OSS){
//        $a = $OSS::publicUpload('yuwenb','yuwen/yuwen1.png','/home/wwwroot/default/yuwen/public/uploads/2018-11-24-11-33-27-5bf8c68718da8.jpg');
//        pd($OSS::getPrivateObjectURLWithExpireTime('yuwen/yuwen1.png','yuwenb',\Faker\Provider\DateTime::dateTime()));
    }
}
