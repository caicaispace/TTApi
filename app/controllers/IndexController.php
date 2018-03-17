<?php

namespace TTDemo\Controllers;

use Phalcon\Di;

class IndexController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Welcome');

        parent::initialize();
    }

    public function indexAction()
    {
//        var_export($this->request->getServer());die;
//        $session = Di::getDefault()->get('session');
//        var_dump($session->getId());die;
        if (!$this->request->isPost()) {
            $this->flash->notice(
                'This is a Phalcon Demo Application. ' .
                "Please don't provide us any personal information. Thanks!"
            );
        }
    }
}
