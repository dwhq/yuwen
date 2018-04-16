<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class mood extends Model
{
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'mood';

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
     * 不允许赋值的字段
     *
     * @var array
     */
    protected $guarded = [];
    public function add($data){
        $id = $this->create($data);
        return $id->id;
    }

}
