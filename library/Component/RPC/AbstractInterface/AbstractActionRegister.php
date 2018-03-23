<?php

namespace Library\Component\RPC\AbstractInterface;


use Library\Component\RPC\Common\ActionList;

abstract class AbstractActionRegister
{
    abstract function register(ActionList $actionList);
}