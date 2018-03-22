<?php

namespace Core\Swoole\Pipe;


abstract class AbstractCommandRegister
{
    abstract function register(CommandList $commandList);
}