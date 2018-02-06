<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class tags extends Model
{
    //
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'tags';
    /**
     * 模型的日期字段的存储格式
     *
     * @var string
     */
    protected $dateFormat = 'U';
    /**
     * 自动维护时间戳
     */
    public $timestamps = false;
    //插入文章ID跟标签ID对应
    public function insert($tag_id,$u_id){
        $this->insertGetId(['u_id'=>$u_id,'tag_id'=>$tag_id]);
    }
}
