<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/1/23
 * Time: 上午12:06
 */

namespace Conf;

use Core\AbstractInterface\AbstractEvent;
use Core\Component\Di;
use Core\Http\Request;
use Core\Http\Response;
use Core\AutoLoader;


class Event extends AbstractEvent
{
    function frameInitialize()
    {
        // TODO: Implement frameInitialize() method.
        date_default_timezone_set('Asia/Shanghai');

        // MysqliDb loader
//        AutoLoader::getInstance()->requireFile("App/Vendor/Db/MysqliDb.php");

        // composer loader
//        AutoLoader::getInstance()->requireFile('vendor/autoload.php');
    }

    function frameInitialized()
    {
//        // mysql
//        $mysqlConfig = Config::getInstance()->getConf('MYSQL');
//        Di::getInstance()->set('MYSQL', MysqliDb::class, $mysqlConfig);

//        // redis
//        $redisConfig = Config::getInstance()->getConf("REDIS");
//        Di::getInstance()->set('REDIS', RedisDb::class, $redisConfig);
    }

    function beforeWorkerStart(\swoole_server $server)
    {
        // TODO: Implement beforeWorkerStart() method.

//         直播
//         \Conf\Live::getInstance()->beforeWorkerStart($server);

        // WebSocket
//        \Conf\WebSocket::getInstance()->beforeWorkerStart($server);

        // WebSocketCommandParser
        // \Conf\WebSocketCommandParser::getInstance()->beforeWorkerStart($server);
    }

    function onStart(\swoole_server $server)
    {
        // TODO: Implement onStart() method.
    }

    function onShutdown(\swoole_server $server)
    {
        // TODO: Implement onShutdown() method.
    }

    function onWorkerStart(\swoole_server $server, $workerId)
    {
        // TODO: Implement onWorkerStart() method.

        // WebSocketCommandParser
        // \Conf\WebSocketCommandParser::getInstance()->onWorkerStart($server, $workerId);

//        $this->_hotReload($server, $workerId);
    }

    function onWorkerStop(\swoole_server $server, $workerId)
    {
        // TODO: Implement onWorkerStop() method.
    }

    function onRequest(Request $request, Response $response)
    {
        // TODO: Implement onRequest() method.
//        $response->writeJson('goodluck');
    }

    function onDispatcher(Request $request, Response $response, $targetControllerClass, $targetAction)
    {
        // TODO: Implement onDispatcher() method.
    }

    function onResponse(Request $request,Response $response)
    {
        // TODO: Implement afterResponse() method.
    }

    function onTask(\swoole_server $server, $taskId, $workerId, $taskObj)
    {
        // TODO: Implement onTask() method.
    }

    function onFinish(\swoole_server $server, $taskId, $taskObj)
    {
        // TODO: Implement onFinish() method.
    }

    function onWorkerError(\swoole_server $server, $worker_id, $worker_pid, $exit_code)
    {
        // TODO: Implement onWorkerError() method.
    }

    private function _hotReload(\swoole_server $server, $workerId)
    {
        if ($workerId == 0) {
            \Core\Swoole\Timer::loop(3000, function(){
                \Core\Swoole\Server::getInstance()->getServer()->reload();
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
