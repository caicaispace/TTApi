<?php

namespace App\Controller\Curl;

use Core\AbstractInterface\AbstractController;
use Core\Http\Message\Status;
use Core\Utility\Curl\Request;

// CURL
class Index extends AbstractController
{
    function index()
    {
        // 获取快递100接口数据
        $param = ['type' => 'zhongtong', 'postid' => '457500981717'];
        $url = 'http://www.kuaidi100.com/query?' . http_build_query($param);
        // 创建Request对象
        $request = new Request($url);
        // 获取Response对象
        $response = $request->exec();
        // 接口返回内容
        $resources = $response->getBody();
        if ($resources) {
            $resources = \json_decode($resources);
        }
        // $this->response()->write($resources);
        $this->response()->writeJson(Status::CODE_OK,$resources,'操作成功');
    }

    function onRequest($actionName)
    {
        // TODO: Implement onRequest() method.
    }

    function actionNotFound($actionName = null, $arguments = null)
    {
        // TODO: Implement actionNotFound() method.
        $this->response()->withStatus(Status::CODE_NOT_FOUND);
    }

    function afterAction()
    {
        // TODO: Implement afterAction() method.
    }

}
