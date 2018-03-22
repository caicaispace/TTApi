<?php

namespace Base\AbstractInterface;


use Core\Component\Di;

abstract class AbstractService
{
    protected $model;

    function __construct()
    {
    }

    public function getModel()
    {
    }
}