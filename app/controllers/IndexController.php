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
        if ($this->request->isPost()) {
            return $this->response->error();
        }
        $data = [
            'ttApi' => 'hello world'
        ];
        $this->response->setRowData($data);
        $this->response->send();
    }
}
