<?php

namespace App\MOdel;

use Illuminate\Database\Eloquent\Model;

class url extends Model
{
    //
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'url';
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
