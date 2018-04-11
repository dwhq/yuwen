<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class user extends Model
{
    /**
     * @var string
     * 不设置的话 操作moods表
     */
//    protected $table = 'users';
    /**
     * 模型的日期字段的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';
    /**
     * 自动维护时间戳
     */
    public $timestamps = true;

    /**
     * @param $data
     * @return bool
     * 添加会员
     */
    public static function add_user($data){
        if ($data['email'] == ''){
            return false;
        }
        $data['account'] = self::user_account();
        $list = DB::table('users')->insertGetId($data);
        if ($list){
            return $list;
        }else{
            return false;
        }
    }

    /**
     * @return int
     * 生成会员编号
     */
    public static function user_account(){
        $account = mt_rand(1000000,9999999);
        $info = DB::table('users')->where([['account',$account]])->exists();
        if ($info){
            self::user_account();
        }else{
            return $account;
        }
    }

    /**
     * @param $id
     * @param string $type
     * @param string $select
     * @return bool
     * 查询会员信息
     */
    public static function user_info($id,$type='id',$select=['id','account','nickname']){
        $info = DB::table('users')->where([["$type",$id]])->select($select)->first();
        if ($info){
            return $info;
        }else{
            return false;
        }
    }
}
