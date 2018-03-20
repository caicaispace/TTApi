<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/18
 * Time: 13:32
 */

namespace TTApiDemo\Controllers;

use Library\Base\AbstractInterface\AController;
use Library\Base\AbstractInterface\IController;
use TTApiDemo\Logics\UserLogic;
use Library\Response;

class UserController extends AController implements IController
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