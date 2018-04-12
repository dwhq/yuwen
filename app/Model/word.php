<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class word extends Model
{
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'word';
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
     * @param $article_id
     * 查询文章的留言
     */
    public static function inquire($article_id){
        $data = DB::table('word as a')->where([['a.u_id',$article_id],['a.state',1],['a.type',1]])->join('users as b','b.id','=','a.name_id')->select('a.*','b.nickname','b.avatar','b.id as user_id')->get();
        foreach ($data as &$vo){
            $vo->level = DB::table('word as a')->where([['a.u_id',$vo->id],['a.state',1],['a.type',3]])->join('users as b','b.id','=','a.name_id')->select('a.*','b.nickname','b.avatar','b.id as user_id')->get();
        }
        return $data;
    }
}
