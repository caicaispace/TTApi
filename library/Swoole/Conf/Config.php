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
        return array(
            "SERVER"=>array(
                "LISTEN"         => "0.0.0.0",
                "SERVER_NAME"    => "easyswoole",
                "PORT"           => 9501,
                "RUN_MODE"       => SWOOLE_PROCESS,//不建议更改此项
                "SERVER_TYPE"    => \Library\Swoole\Init\Config::SERVER_TYPE_WEB,//
//                "SERVER_TYPE"    => \Library\Swoole\Config::SERVER_TYPE_WEB_SOCKET,// 直播打开
//                'SOCKET_TYPE'    => SWOOLE_TCP,//当SERVER_TYPE为SERVER_TYPE_SERVER模式时有效
                "CONFIG"=>array(
                    'user'             => USER, //当前用户
                    'group'            => USER_GROUP, //当前用户组
                    'task_worker_num'  => 8, //异步任务进程
                    'task_max_request' => 10,
                    'max_request'      => 5000,//强烈建议设置此配置项
                    'worker_num'       => 8,
//                    'log_file'         => Di::getInstance()->get(SysConst::LOG_DIRECTORY)."/swoole.log",
//                    'pid_file'         => ROOT . "/runtime/pid.pid",
                    'document_root'         => ROOT.'/public',
                    'enable_static_handler' => true,
                ),
            ),
            "MYSQL" => array(
                'host'     => 'localhost',
                'username' => 'root',
                'password' => 'goodluck888',
                'db'       => 'es',
                'port'     => 3306,
                'charset'  => 'utf8'
            ),
            "REDIS"=>array(
                "host"=>'localhost',
                "port"=>6379,
                "auth"=>''
            ),
            "DEBUG"=>array(
                "LOG"=>1,
                "DISPLAY_ERROR"=>1,
                "ENABLE"=>true,
            ),
            "CONTROLLER_POOL"=>true//web或web socket模式有效
        );
    }

    private function userConf(){
        return array();
    }
}