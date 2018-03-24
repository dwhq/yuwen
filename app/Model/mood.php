<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class mood extends Model
{
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'mood';
    /**
     * @return string
     * 模型的日期字段的存储格式
     */
    protected function getDateFormat()
    {
        return 'U';
    }
    /**
     * 不允许赋值的字段
     *
     * @var array
     */
    protected $guarded = [];
    /**
     * select的时候避免转换时间为Carbon
     *
     * @param mixed $value
     * @return mixed
     */
//  protected function asDateTime($value) {
//	  return $value;
//  }
    /**
     * 自动维护时间戳
     */
    public $timestamps = true;


}
