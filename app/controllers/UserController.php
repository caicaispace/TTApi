<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/18
 * Time: 13:32
 */

namespace TTApiDemo\Controllers;

use TTApiDemo\Models\Users;

class UserController extends ControllerBase
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        $data = [
            'test' => 'goodluck'
        ];
        return \json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function infoAction()
    {
        $userData = [];
        if ($user = Users::findFirst()) {
            $userData = $user->toArray();
        }
        $data = [
            'info' => $userData,
        ];
//        $this->response->setContentType("application/json");
//        $this->response->setContent(\json_encode($data));
//        $this->response->send();
        return \json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}