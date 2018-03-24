<?php

namespace TTApiDemo\Controllers;

use Library\Base\Phalcon\BController;
use Library\Base\Phalcon\AbstractInterface\IController;
use TTApiDemo\Logics\UserLogic;

class UserController extends BController implements IController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function listAction()
    {
        $logic = new UserLogic;
        $userData = [];
        if ($user = $logic->getList()) {
            $userData = $user->toArray();
        }
        $this->response->setStatusCode(400);
        $this->response->setListData($userData);
        $this->response->send();
    }

    public function infoAction()
    {
        $logic = new UserLogic;
        $userData = [];
        if ($user = $logic->getInfo()) {
            $userData = $user->toArray();
        }
        $this->response->setRowData($userData);
        $this->response->send();
    }

    public function createAction()
    {
        // TODO: Implement createAction() method.
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