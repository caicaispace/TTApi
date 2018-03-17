<?php
/**
 * Created by PhpStorm.
 * User: yf
 * Date: 2017/9/27
 * Time: 上午11:58
 */

namespace App\Controller\WebSocket;

use Core\AbstractInterface\AbstractController;
use Core\Http\Message\Status;
use Core\Component\Logger;
use Core\Swoole\AsyncTaskManager;
use Core\Swoole\Server;

class WebSocket extends AbstractController
{

    function index()
    {
        // TODO: Implement index() method.
        $this->response()->write(file_get_contents(ROOT."/App/Static/Template/websocket_client.html"));
    }

    function onRequest($actionName)
    {
        // TODO: Implement onRequest() method.
    }

    function actionNotFound($actionName = null, $arguments = null)
    {
        // TODO: Implement actionNotFound() method.
        $this->response()->withStatus(Status::CODE_NOT_FOUND);
        $this->response()->write(file_get_contents(ROOT."/App/Static/404.html"));
    }

    function afterAction()
    {
        // TODO: Implement afterAction() method.
    }

    // 推送
    function push()
    {
        /*
         * url :/webSocket/push/index.html?fd=xxxx
         */
        $fd = $this->request()->getRequestParam("fd");
        $info =  Server::getInstance()->getServer()->connection_info($fd);
        if ($info['websocket_status']) {
            Logger::getInstance()->console("push data to client {$fd}");
            Server::getInstance()->getServer()->push($fd, "data from server at ".time());
            $this->response()->write("push to fd :{$fd}");
        } else {
            $this->response()->write("fd {$fd} not a websocket");
        }
    }

    // 当前链接数
    function connectionList()
    {
        /*
         * url:/webSocket/connectionList/index.html
         * 注意   本example未引入redis来做fd信息记录，因此每次采用遍历的形式来获取结果，
         * 仅供思路参考，不建议在生产环节使用
         */
        $server = Server::getInstance()->getServer();
        $list = array();
        foreach ($server->connections as $connection) {
            $info =  $server->connection_info($connection);
            if ($info['websocket_status']) {
                $list[] = $connection;
            }
        }
        $list = Server::getInstance()->getServer()->connection_list();
        $this->response()->writeJson(200, $list, "this is all websocket list");
    }

    // 广播
    function broadcast()
    {
        /*
         * url :/webSocket/broadcast/index.html?fds=xx,xx,xx
         */
        $fds = $this->request()->getRequestParam("fds");
        $fds = explode(",", $fds);
        AsyncTaskManager::getInstance()->add(function () use ($fds) {
            foreach ($fds as $fd) {
                Server::getInstance()->getServer()->push($fd, "this is broadcast");
            }
        });
        $this->response()->write('broadcast to client');
    }

    // 广播全部
    function broadcastAll()
    {
        /*
         * url :/webSocket/broadcastAll
         */
        $fds = array();
        foreach (Server::getInstance()->getServer()->connections as $connection) {
            $info =  Server::getInstance()->getServer()->connection_info($connection);
            if ($info['websocket_status']) {
                $fds[] = $connection;
            }
        }
        AsyncTaskManager::getInstance()->add(function () use ($fds) {
            foreach ($fds as $fd) {
                Server::getInstance()->getServer()->push($fd, "this is broadcast all");
            }
        });
        $this->response()->write('broadcast to all client');
    }
}
