<?php

namespace App\Controller\WebSocket;

use Core\AbstractInterface\AbstractController;

class WebSocketCommandParser extends AbstractController
{

    function index()
    {
        // TODO: Implement index() method.
        $this->response()->write(file_get_contents(ROOT."/App/Static/Template/websocket_command_parser_client.html"));
    }

    function onRequest($actionName)
    {
        // TODO: Implement onRequest() method.
    }

    function actionNotFound($actionName = null, $arguments = null)
    {
        // TODO: Implement actionNotFound() method.
        $this->response()->withStatus(404);
    }

    function afterAction()
    {
        // TODO: Implement afterAction() method.
    }
}
