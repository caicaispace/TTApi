<?php

namespace TTApiDemo\Controllers;

use Library\Base\AbstractInterface\AController;


class ErrorsController extends AController
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
