<?php
namespace App\Model;


use Base\AbstractInterface\AbstractModel;

class Goods extends AbstractModel
{
    // 模型初始化
    public static function init()
    {
        self::event('before_insert', function ($table) {
            $table->goods_id = \mt_rand(100000000, 999999999);
        });
    }
}
