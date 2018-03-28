<?php

namespace App\Controllers;

use Library\Base\Phalcon\BController;


class IndexController extends BController
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
