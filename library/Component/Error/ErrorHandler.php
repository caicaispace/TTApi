<?php

namespace Library\Component\Error;


use Library\Base\Swoole\AbstractInterface\ErrorHandlerInterface;
use Library\Component\Logger;
use Library\Http\Request;
use Library\Http\Response;

class ErrorHandler  implements ErrorHandlerInterface
{
    function handler($msg,$file = null,$line = null,$errorCode = null, $trace)
    {
        // TODO: Implement handler() method.
    }

    function display($msg,$file = null,$line = null,$errorCode = null, $trace)
    {
        // TODO: Implement display() method.
        //判断是否在HTTP模式下
        if(Request::getInstance()){
            Response::getInstance()->setContent($msg ." in file {$file} line {$line}");
//            Response::getInstance()->write($msg ." in file {$file} line {$line}");
        }else{
            Logger::getInstance('error')->console($msg." in file {$file} line {$line}",false);
        }
    }

    function log($msg,$file = null,$line = null,$errorCode = null, $trace)
    {
        // TODO: Implement log() method.
        Logger::getInstance('error')->log($msg." in file {$file} line {$line}");
    }

}