<?php

namespace Library\Component\Socket\AbstractInterface;


use Library\Component\RPC\Client\Client;
use Library\Component\Socket\Common\Command;

abstract class AbstractCommandParser
{
    abstract function parser(Command $result,AbstractClient $client,$rawData);
}