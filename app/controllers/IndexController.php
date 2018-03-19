<?php

namespace TTApiDemo\Controllers;

use Library\Base\AbstractInterface\AController;


class IndexController extends AController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->flash->notice(
                'This is a TTApi Demo Application. ' .
                "Please don't provide us any personal information. Thanks!"
            );
        }
    }
}
