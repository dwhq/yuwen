<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class info extends Model
{
    //
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'info';
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
}
