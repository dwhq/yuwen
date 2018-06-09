<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;
use App\Model\tags;

class article extends Model
{
    use Searchable;
    /**
     * @var string
     * 不设置的话 操作moods表
     */
    protected $table = 'article';
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
     * 索引的字段
     *
     * @return array
     */
    public function toSearchableArray()
    {
        return $this->only('id','title', 'desc', 'account');
    }
}
