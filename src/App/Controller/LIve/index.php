<?php

namespace App\Controller\Live;

use Core\AbstractInterface\AbstractController;
use Core\Http\Message\Status;

// 直播
class Index extends AbstractController
{
    function index()
    {
        // TODO: Implement index() method.
        $content = file_get_contents(ROOT."/App/Static/Live/index.html");
        $this->response()->write($content);
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

    function camera()
    {
        $content = file_get_contents(ROOT."/App/Static/Live/camera.html");
        $this->response()->write($content);
    }
}
