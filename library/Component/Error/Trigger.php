<?php

namespace Library\Component\Error;


use Library\Swoole\Conf\Config;
use Library\Base\Swoole\AbstractInterface\ErrorHandlerInterface;
use Library\Base\Swoole\AbstractInterface\ExceptionHandlerInterface;
use Library\Component\DI;
use Library\Component\SysConst;

class Trigger
{
    public static function error($msg,$file = null,$line = null,$errorCode = E_USER_ERROR,$trace = null){
        $conf = Config::getInstance()->getConf("DEBUG");
        if($trace == null){
            $trace = debug_backtrace();
        }
        $handler = DI::getInstance()->get(SysConst::ERROR_HANDLER);
        if(!$handler instanceof ErrorHandlerInterface){
            $handler = new ErrorHandler();
        }
        $handler->handler($msg,$file,$line,$errorCode,$trace);
        if($conf['DISPLAY_ERROR'] == true){
            $handler->display($msg,$file,$line,$errorCode,$trace);
        }
        if($conf['LOG'] == true){
            $handler->log($msg,$file,$line,$errorCode,$trace);
        }
    }

    public static function exception(\Exception $exception){
        $conf = Config::getInstance()->getConf("DEBUG");
        $handler = DI::getInstance()->get(SysConst::EXCEPTION_HANDLER);
        if(!$handler instanceof ExceptionHandlerInterface){
            $handler = new ExceptionHandler();
        }
        $handler->handler($exception);
        if($conf['DISPLAY_ERROR'] == true){
            $handler->display($exception);
        }
        if($conf['LOG'] == true){
            $handler->log($exception);
        }
    }
}