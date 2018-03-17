<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/1/23
 * Time: 上午1:07
 */
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