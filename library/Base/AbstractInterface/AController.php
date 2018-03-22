<?php

namespace Library\Base\AbstractInterface;

use Phalcon\Mvc\Controller;
use Library\Http\Response;

class AController extends Controller
{
    public $response;

    public function initialize()
    {
        $this->response = Response::getInstance();
    }

    public function forward($uri)
    {
        $uriParts = explode('/', $uri);
        $params = array_slice($uriParts, 2);

        return $this->dispatcher->forward(
            [
                'controller' => $uriParts[0],
                'action'     => $uriParts[1],
                'params'     => $params
            ]
        );
    }
}