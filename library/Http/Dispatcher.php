<?php

namespace Library\Http;

use Library\Swoole\Conf\Config;
use Library\Swoole\Conf\Event;
use Library\Component\Di;
use Library\Component\SysConst;
use Library\Swoole\Init\Server;
use Library\Http\Response as HttpResponse;


class Dispatcher
{
    protected static $selfInstance;
    protected $fastRouterDispatcher;
    protected $controllerPool = array();
    protected $useControllerPool = false;
    protected $controllerMap = array();
    static function getInstance(){
        if(!isset(self::$selfInstance)){
            self::$selfInstance = new Dispatcher();
        }
        return self::$selfInstance;
    }

    function __construct()
    {
        $this->useControllerPool = Config::getInstance()->getConf("CONTROLLER_POOL");
    }

    function dispatch(){
        if(HttpResponse::getInstance()->isEndResponse()){
            return false;
        }
        $request = Request::getInstance();
        $response = HttpResponse::getInstance();
        $request2 = $request->getSwooleRequest();
        $phalconApplication = Server::getInstance()->getPhalconApplication();

        //注册捕获错误函数
        if ($request2->server['request_uri'] == '/favicon.ico' || $request2->server['path_info'] == '/favicon.ico') {
            return $response->end(true);
        }
        $_SERVER = $request2->server + $_SERVER;
        $_COOKIE = $request2->cookie;

        //构造url请求路径,phalcon获取到$_GET['_url']时会定向到对应的路径，否则请求路径为'/'
        $_GET['_url'] = $request2->server['request_uri'];
        $request2->get['_url'] = $request2->server['request_uri'];
        if ($request2->server['request_method'] == 'GET' AND isset($request2->get)) {
            foreach ($request2->get as $key => $value) {
                $_GET[$key] = $value;
                $_REQUEST[$key] = $value;
            }
        }
        if ($request2->server['request_method'] == 'POST' AND isset($request2->post) ) {
            foreach ($request2->post as $key => $value) {
                $_POST[$key] = $value;
                $_REQUEST[$key] = $value;
            }
        }
        if (APPLICATION_ENV == APP_TEST) {
            return $phalconApplication;
        } else {
            $phalconApplicationResponse = $phalconApplication->handle();
            $content = \json_decode($phalconApplicationResponse->getContent(), JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
            $response->setJsonContent($content);
        }
    }

}