<?php

namespace Core\Component\Socket\AbstractInterface;


use Core\Component\Socket\Common\CommandList;

abstract class AbstractCommandRegister
{
    abstract function register(CommandList $commandList);
}