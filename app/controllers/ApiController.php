<?php

namespace App\Controllers;

use Library\Base\Phalcon\BController;

class ApiController extends BController
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