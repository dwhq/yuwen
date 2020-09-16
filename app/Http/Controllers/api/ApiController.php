<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2018/4/19
 * Time: 11:18
 */
namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApiController extends Controller{
    private   $key = 'b0e12c466524c86b43668a9d9d5004d8';
    /**
     * @param Request $request
     * @return array|false|string
     * 返回地址
     */
    public function address(Request $request)
    {
        $url = 'https://restapi.amap.com/v3/geocode/geo';
        $address = $request->input('address');
        $key = 'b0e12c466524c86b43668a9d9d5004d8';
        $output='json';
        $data = ['address'=>$address,'key'=>$key,'output'=>$output];
        $url .='?'.http_build_query($data);
        $data = $this->http_curl($url);
        return $data;
    }

    /**
     * @param Request $request
     * @return array
     * 返回英文单词的复数形式
     */
    public function plural(Request $request)
    {
        $string = $request->input('string');
        if (!$string){
            return ['data'=>'','msg'=>'请输入字符串','code'=>500];
        }
        $plural  = Str::plural($string);
        return ['复数'=>$plural];
    }
    public function http_curl($url, $data=[], $type = 'GET')
    {
        $postdata = http_build_query(
            $data
        );
        $opts = array('http' =>
            array(
                'method' => $type,
                'header' => 'Content-type: application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 10 // 超时时间（单位:s）
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents($url, false, $context);
        return $result;
    }

    /**
     * @param Request $request
     * @return array|false|string
     * ip 定位;
     */
    public function ip(Request $request)
    {
        $url = 'https://restapi.amap.com/v3/ip';
        $ip = $request->input('ip');
        if (!$ip) $ip = $request->getClientIp();
        $key = $this->key;
        $output='json';
        $data = ['ip'=>$ip,'key'=>$key,'output'=>$output];
        $url .='?'.http_build_query($data);
        $data = $this->http_curl($url);
        return $data;
    }

    /**
     * @param Request $request
     * @return array|false|string
     * 查询天气
     */
    public function weather(Request $request)
    {
        $url = 'https://restapi.amap.com/v3/weather/weatherInfo';
        $city = $request->input('city');
        $city = $this->districts($city);
        if ($city['districts'])
        {
            $city = $city['districts'][0]['adcode'];
        }else{
            return ['','msg'=>'请求失败'];
        }
        $key = $this->key;
        $output='json';
        $data = ['city'=>$city,'key'=>$key,'output'=>$output];
        $url .='?'.http_build_query($data);
        $data = $this->http_curl($url);
        return $data;
    }

    /**
     * @param Request $request
     * @return array|false|string
     * 查询地址
     */
    public function district(Request $request)
    {
        $url = 'https://restapi.amap.com/v3/config/district';
        $keywords = $request->input('keywords');
        $key = $this->key;
        $output='json';
        $data = ['keywords'=>$keywords,'key'=>$key,'output'=>$output];
        $url .='?'.http_build_query($data);
        $data = $this->http_curl($url);
        return $data;
    }
    public function districts($city)
    {
        $url = 'https://restapi.amap.com/v3/config/district';
        $key = $this->key;
        $output='json';
        $data = ['keywords'=>$city,'key'=>$key,'output'=>$output];
        $url .='?'.http_build_query($data);
        $data = $this->http_curl($url);
        return json_decode($data,true);
    }
}