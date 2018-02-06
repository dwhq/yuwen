<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\tags;
class tag extends Model
{
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'tag';
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

    /**
     * @param $id
     * @param $data
     * 把文章跟标签对应起来
     */
    public function write($u_id,$data){
        //传过来的是个字符串先把字符串分隔开
        $label = explode(',', $data);
        foreach ($label as $vo){
            if ($vo != ''){
                $id=$this->inquire($vo);
                //返回标签的ID然后插入tags表对应起来
                if ($id) {
                    //两个对应
                    $tags = new tags();
                    $tags->insert($id,$u_id);
                }
            }
        }
    }

    /**
     * 查询标签的ID
     * 如果不存在就插入这个标签
     */
    public function inquire($name){
        $tag = $this->where([['name',$name]])->value('id');
        if (!$tag){
            $tag = $this->insertGetId(['name'=>$name]);
        }
        return $tag;
    }

}
