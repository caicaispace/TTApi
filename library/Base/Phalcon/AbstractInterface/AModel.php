<?php

namespace Library\Base\Phalcon\AbstractInterface;

use Phalcon\Mvc\Model;

abstract class AModel extends Model
{
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'create_at';
    protected $updateTime = 'update_at';

//    static function findFirst($parameters = null)
//    {
//        $parameters['limit'] = 1;
//        return parent::find($parameters)[0];
//    }
}