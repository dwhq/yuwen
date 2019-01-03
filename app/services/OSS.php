<?php
/**
 * Created by PhpStorm.
 * User: diwuh
 * Date: 2019/1/3
 * Time: 13:43
 */
namespace App\Services;
use JohnLui\AliyunOSS;
use Exception;
use DateTime;
class OSS {
    /* 城市名称：
      *
      *  经典网络下可选：杭州、上海、青岛、北京、张家口、深圳、香港、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
      *  VPC 网络下可选：杭州、上海、青岛、北京、张家口、深圳、硅谷、弗吉尼亚、新加坡、悉尼、日本、法兰克福、迪拜
      */
    private $city = '青岛';
    // 经典网络 or VPC
    private $networkType = '经典网络';

    private $AccessKeyId = '';
    private $AccessKeySecret = '';

}