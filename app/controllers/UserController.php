<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/18
 * Time: 13:32
 */

namespace TTDemo\Controllers;

use TTDemo\Models\Users;

class UserController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('user');
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
        header('Content-type: application/json');
        return \json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}