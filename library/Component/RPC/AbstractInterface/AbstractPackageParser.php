<?php

namespace Library\Component\RPC\AbstractInterface;


use Library\Component\RPC\Common\Package;
use Library\Component\Socket\Client\TcpClient;

abstract class AbstractPackageParser
{
    abstract function decode(Package $result,TcpClient $client,$rawData);

    /*
     * must return string
     */
    abstract function encode(Package $res);
}