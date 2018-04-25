<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class admin extends Model
{
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'admin';
    /**
     * 模型的日期字段的存储格式
     *
     * @var string
     */
    //protected $dateFormat = 'U';
    /**
     * 自动维护时间戳
     */
    public $timestamps = false;
    /**
     * 不允许赋值的字段
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * @param $data
     * @return bool
     * 添加会员
     */
    public function add_admin($data){

        $list = $this->create($data);
        if ($list){
            return $list->id;
        }else{
            return false;
        }
    }

    public static function admin_info($name,$select=['id','name','mobile','auth_group_id'],$type= 'name'){
        $info = DB::table('admin')->where([["$type",$name]])->select($select)->first();
        if ($info){
            return $info;
        }else{
            return false;
        }
    }
}
