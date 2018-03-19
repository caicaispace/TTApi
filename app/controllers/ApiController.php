<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/17
 * Time: 14:42
 */

namespace TTApiDemo\Controllers;

use Library\Base\AbstractInterface\AController;

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