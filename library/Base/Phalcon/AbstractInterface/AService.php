<?php

namespace Library\Base\Phalcon\AbstractInterface;

use Library\Component\Di;

abstract class AService
{
    protected $model;

    function __construct()
    {
    }

    public function getModel()
    {
    }
}