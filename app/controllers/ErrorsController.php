<?php

namespace TTApiDemo\Controllers;

use Library\Base\Phalcon\BController;


class ErrorsController extends BController
{
    public function initialize()
    {
        parent::initialize();
    }

    public function show404Action()
    {
    }

    public function show401Action()
    {
    }

    public function show500Action($exception)
    {
    }
}
