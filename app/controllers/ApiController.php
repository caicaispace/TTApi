<?php

namespace TTApiDemo\Controllers;

use Library\Base\Phalcon\AbstractInterface\AController;

class ApiController extends AController
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

    public function success_msgAction()
    {
        $data = [
            'msg' => 'success'
        ];
        return \json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function error_msgAction()
    {
        $data = [
            'msg' => 'error'
        ];
        return \json_encode($data, JSON_UNESCAPED_UNICODE);
    }
}