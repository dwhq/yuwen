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
    //protected $dateFormat = 'U';
    /**
     * 自动维护时间戳
     */
    public $timestamps = false;

    /**
     * @param $article_id
     * 查询文章的留言
     */
    public static function inquire($article_id)
    {
        $data = DB::table('word as a')->where([['a.u_id', $article_id], ['a.state', 1], ['a.type', 1]])->join('users as b', 'b.id', '=', 'a.name_id')->select('a.*', 'b.nickname', 'b.avatar', 'b.id as user_id')->get();
        foreach ($data as &$vo){
            $word = DB::table('word')->where([['u_id', $vo->id]])->exists();
            if ($word){
                $vo->level = self::two_word($vo->id);
            }
        }
        return $data;
    }

    /**
     * 查询回复留言
     */
    private static function two_word($id,$array=array())
    {
        $data = DB::table('word as a')->where([['a.u_id',$id], ['a.state', 1], ['a.type', 3]])
            ->join('users as b', 'b.id', '=', 'a.name_id')
            ->join('word as c', 'c.id', '=', 'a.u_id')
            ->join('users as d', 'd.id', '=', 'c.name_id')
            ->select('a.*', 'b.nickname', 'b.avatar', 'b.id as user_id', 'd.nickname as father_nickname', 'd.avatar as father_avatar', 'd.id as father_user_id')->get()->toarray();
            foreach ($data as $vo){
                $word = DB::table('word')->where([['u_id', $vo->id]])->exists();
                if ($word){
                    $array = self::two_word($vo->id,$data);
                    $data = array_merge_recursive($data,$array);
                }
            }
        return $data;
    }
}
