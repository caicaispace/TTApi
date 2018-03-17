<?php
/**
 * Created by PhpStorm.
 * User: aofeide
 * Date: 2018/3/9
 * Time: 上午9:46
 */
namespace Core;

use Phalcon\Loader;

class AutoLoader extends Loader
{
    protected static $instance;
    static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
}