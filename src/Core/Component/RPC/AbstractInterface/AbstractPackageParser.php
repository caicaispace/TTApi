<?php

namespace Core\Component\RPC\AbstractInterface;


use Core\Component\RPC\Common\Package;
use Core\Component\Socket\Client\TcpClient;

abstract class AbstractPackageParser
{
    abstract function decode(Package $result,TcpClient $client,$rawData);

    /*
     * must return string
     */
    abstract function encode(Package $res);
}