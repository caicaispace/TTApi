<?php
namespace App\Controller\Api;

use Core\AbstractInterface\AbstractController;
use Core\Http\Message\Status;
use Core\Component\Di;



class Redis extends AbstractController
{

    function index()
    {
        // TODO: Implement index() method.
        $this->response()->write("this is api index");/*  url:domain/api/index.html  domain/api/  */
    }

    function afterAction()
    {
        // TODO: Implement afterAction() method.
    }

    function onRequest($actionName)
    {
        // TODO: Implement onRequest() method.
    }

    function actionNotFound($actionName = null, $arguments = null)
    {
        // TODO: Implement actionNotFount() method.
        $this->response()->withStatus(Status::CODE_NOT_FOUND);
    }

    function afterResponse()
    {
        // TODO: Implement afterResponse() method.
    }

    function get()
    {
        $redis = Di::getInstance()->get("REDIS");
        $redis = $redis->getConnect();
        $data = $redis->get('currentDay');
        $this->response()->writeJson(Status::CODE_OK,$data,'操作成功');
    }

    function set()
    {
        $redis = Di::getInstance()->get("REDIS");
        $redis = $redis->getConnect();
        $res = $redis->set('currentDay','2017-11-2');
        $this->response()->writeJson(Status::CODE_OK,$res,'操作成功');
    }
}
