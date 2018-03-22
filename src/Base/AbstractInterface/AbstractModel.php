<?php

namespace Base\AbstractInterface;

use think\Model;

abstract class AbstractModel extends Model
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';

//    public static function init()
//    {
//        if(method_exists(self::class,'initialize')){
//            self::initialize();
//        }
//    }
}