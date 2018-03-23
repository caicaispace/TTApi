<?php

namespace Library\Swoole\Pipe;


abstract class AbstractCommandRegister
{
    abstract function register(CommandList $commandList);
}