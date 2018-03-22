<?php

namespace Conf;

use Core\AbstractInterface\AbstractEvent;
use Core\Component\Di;
use Core\Http\Request;
use Core\Http\Response;
use Library\Http\Response as HttpResponse;
use Core\AutoLoader;


class Event extends AbstractEvent
{
    function frameInitialize()
    {
//        date_default_timezone_set('Asia/Shanghai');
//        /*MysqliDb loader*/
//        AutoLoader::getInstance()->requireFile("App/Vendor/Db/MysqliDb.php");
//        /*composer loader*/
//        AutoLoader::getInstance()->requireFile('vendor/autoload.php');
    }

    function frameInitialized()
    {
//        /*mysql*/
//        $mysqlConfig = Config::getInstance()->getConf('MYSQL');
//        Di::getInstance()->set('MYSQL', MysqliDb::class, $mysqlConfig);
//        /*redis*/
//        $redisConfig = Config::getInstance()->getConf("REDIS");
//        Di::getInstance()->set('REDIS', RedisDb::class, $redisConfig);
    }

    function beforeWorkerStart(\swoole_server $server)
    {
//        /*直播*/
//        \Conf\Live::getInstance()->beforeWorkerStart($server);
//        /*WebSocket*/
//        \Conf\WebSocket::getInstance()->beforeWorkerStart($server);
//        /*WebSocketCommandParser*/
//        \Conf\WebSocketCommandParser::getInstance()->beforeWorkerStart($server);
    }

    function onStart(\swoole_server $server)
    {
    }

    function onShutdown(\swoole_server $server)
    {
    }

    function onWorkerStart(\swoole_server $server, $workerId)
    {
        /**
         * Database connection is created based in the parameters defined in the configuration file
         */
        $di = Di::getInstance()->getPhalconAppDi();
        $config = $di->getShared('config');
        $di->setShared('db', function () use ($config) {
            $config = $config->get('database')->toArray();
            $dbClass = 'Phalcon\Db\Adapter\Pdo\\' . $config['adapter'];
            unset($config['adapter']);
            $config += [
                "options"  => [ //长连接配置
                    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8mb4'",
                    \PDO::ATTR_PERSISTENT => true,//长连接
                ]
            ];
            return new $dbClass($config);
        });

        $di->setShared('cacheMemcache', function () {
            $frontCache = new \Phalcon\Cache\Frontend\Data(
                [
                    "lifetime" => 86400,
                ]
            );
            $cache = new \Phalcon\Cache\Backend\Libmemcached(
                $frontCache,
                [
                    "servers" => [
                        [
                            "host"   => '127.0.0.1',
                            "port"   => 11211,
                            "weight" => 1,
                        ],
                    ],
                    "client" => [
                        \Memcached::OPT_HASH       => \Memcached::HASH_MD5,
                        \Memcached::OPT_PREFIX_KEY => "prefix.",
                    ],
                    "prefix"   => 'home_',
                ]
            );
            return $cache;
        });

//        /*WebSocketCommandParser*/
//        \Conf\WebSocketCommandParser::getInstance()->onWorkerStart($server, $workerId);
//        /*hotReload*/
//        $this->_hotReload($server, $workerId);
    }

    function onWorkerStop(\swoole_server $server, $workerId)
    {
    }

    function onRequest(Request $request, HttpResponse $response)
    {
    }

    function onDispatcher(Request $request, Response $response, $targetControllerClass, $targetAction)
    {
    }

    function onResponse(Request $request,HttpResponse $response)
    {
    }

    function onTask(\swoole_server $server, $taskId, $workerId, $taskObj)
    {
    }

    function onFinish(\swoole_server $server, $taskId, $taskObj)
    {
    }

    function onWorkerError(\swoole_server $server, $worker_id, $worker_pid, $exit_code)
    {
    }

    private function _hotReload(\swoole_server $server, $workerId)
    {
        if ($workerId == 0) {
            \Core\Swoole\Timer::loop(3000, function(){
                \Core\Swoole\Server::getInstance()->getServer()->reload();
                echo 'server reloaded'.PHP_EOL;
            });
        }

        // $pidFile = \Conf\Config::getInstance()->getConf("SERVER.CONFIG.pid_file");
        // // echo $pidFile;
        // if(!file_exists($pidFile)){
        //     echo "pid file :{$pidFile} not exist \n";
        //     return;
        // }
        // $pid = file_get_contents($pidFile);
        // echo $pid;
        // $kit = new \Core\AutoReload($pid);
        // $kit->watch(ROOT . "/App");
        // $kit->run();


        // //请确定有inotify拓展
        // if ($workerId == 0) {
        //     // 递归获取所有目录和文件
        //     $a = function ($dir) use (&$a) {
        //         $data = array();
        //         if (is_dir($dir)) {
        //             //是目录的话，先增当前目录进去
        //             $data[] = $dir;
        //             $files = \array_diff(scandir($dir), array('.', '..'));
        //             foreach ($files as $file) {
        //                 $data = \array_merge($data, $a($dir . "/" . $file));
        //             }
        //         } else {
        //             $data[] = $dir;
        //         }
        //         return $data;
        //     };
        //     $list = $a(ROOT . "/App");
        //     // var_dump($list);
        //     $notify = \inotify_init();
        //     // 为所有目录和文件添加inotify监视
        //     foreach ($list as $item) {
        //         \inotify_add_watch($notify, $item, IN_ALL_EVENTS);
        //         // \inotify_add_watch($notify, $item, IN_CREATE | IN_DELETE | IN_MODIFY);                
        //     }
        //     // 加入EventLoop
        //     \swoole_event_add($notify, function () use ($notify) {
        //         $events = \inotify_read($notify);
        //         if (!empty($events)) {
        //             echo time();
        //             //注意更新多个文件的间隔时间处理,防止一次更新了10个文件，重启了10次，懒得做了，反正原理在这里
        //             Server::getInstance()->getServer()->reload();
        //         }
        //     });
        // }
    }
}
