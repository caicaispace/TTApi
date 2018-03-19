<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 22:27
 */

namespace Library\Base\AbstractInterface;

use Phalcon\Mvc\Controller;
use Library\Response;

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