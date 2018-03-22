<?php

namespace Core\Component\RPC\AbstractInterface;


use Core\Component\RPC\Common\ActionList;

abstract class AbstractActionRegister
{
    abstract function register(ActionList $actionList);
}