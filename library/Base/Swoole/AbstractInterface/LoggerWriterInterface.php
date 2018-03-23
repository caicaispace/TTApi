<?php

namespace Library\Base\Swoole\AbstractInterface;


interface LoggerWriterInterface
{
    static function writeLog($obj,$logCategory,$timeStamp);
}