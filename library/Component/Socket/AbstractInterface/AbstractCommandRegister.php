<?php

namespace Library\Component\Socket\AbstractInterface;


use Library\Component\Socket\Common\CommandList;

abstract class AbstractCommandRegister
{
    abstract function register(CommandList $commandList);
}