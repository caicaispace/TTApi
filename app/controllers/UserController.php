<?php

namespace App\Controllers;

use Library\Base\Phalcon\BController;
use Library\Base\Phalcon\AbstractInterface\IController;
use App\Logics\UserLogic;

class UserController extends BController implements IController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function listAction()
    {
        $logic = new UserLogic;
        if (!$user = $logic->getList()) {
            return $this->response->error();
        }
        $userData = $user->toArray();
        $this->response->setListData($userData);
        $this->response->send();
    }

    public function infoAction()
    {
        $logic = new UserLogic;
        if (!$user = $logic->getInfo()) {
            return $this->response->error();
        }
        $userData = $user->toArray();
        $this->response->setRowData($userData);
        $this->response->send();
    }

    public function createAction()
    {
        $logic = new UserLogic;
        if (!$result = $logic->create()) {
            return $this->response->error();
        }
        $this->response->success();
    }

    public function updateAction()
    {
        // TODO: Implement updateAction() method.
    }

    public function deleteAction()
    {
        // TODO: Implement deleteAction() method.
    }
}