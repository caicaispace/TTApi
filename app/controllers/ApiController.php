<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/17
 * Time: 14:42
 */

namespace TTDemo\Controllers;


class ApiController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('api');

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