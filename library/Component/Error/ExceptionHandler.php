<?php

namespace Library\Component\Error;


use Library\Base\Swoole\AbstractInterface\ExceptionHandlerInterface;
use Library\Component\Logger;
use Library\Http\Request;
use Library\Http\Response;

class ExceptionHandler implements ExceptionHandlerInterface
{

    function handler(\Exception $exception)
    {
        // TODO: Implement handler() method.
    }

    function display(\Exception $exception)
    {
        if(Request::getInstance()){
            Response::getInstance()->setContent(nl2br($exception->getMessage().$exception->getTraceAsString()));
//            Response::getInstance()->write(nl2br($exception->getMessage().$exception->getTraceAsString()));
        }else{
            Logger::getInstance('error')->console($exception->getMessage().$exception->getTraceAsString(),false);
        }
    }

    function log(\Exception $exception)
    {
        Logger::getInstance('error')->log($exception->getMessage()." ".$exception->getTraceAsString());
    }
}