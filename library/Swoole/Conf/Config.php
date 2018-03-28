<?php

namespace Library\Swoole\Conf;

use Library\Component\Di;
use Library\Component\Spl\SplArray;
use Library\Component\SysConst;

class Config
{
    private static $instance;
    protected $conf;
    function __construct()
    {
        $conf = $this->sysConf()+$this->userConf();
        $this->conf = new SplArray($conf);
    }
    static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
    function getConf($keyPath){
        return $this->conf->get($keyPath);
    }
    /*
    * 在server启动以后，无法动态的去添加，修改配置信息（进程数据独立）
    */
    function setConf($keyPath,$data){
        $this->conf->set($keyPath,$data);
    }

    private function sysConf(){
        $config = Di::getInstance()->getPhalconAppDi()->get('config')->swoole->toArray();
        $config['CONFIG']['user'] = USER; //当前用户
        $config['CONFIG']['group'] = USER_GROUP; //USER_GROUP
        return $config;
    }

    private function userConf(){
        return array();
    }
}