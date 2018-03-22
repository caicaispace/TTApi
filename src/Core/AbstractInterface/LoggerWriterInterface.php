<?php

namespace Core\AbstractInterface;


interface LoggerWriterInterface
{
    static function writeLog($obj,$logCategory,$timeStamp);
}