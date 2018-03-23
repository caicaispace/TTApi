<?php

namespace Library\Base\Swoole\AbstractInterface;


interface ExceptionHandlerInterface
{
    function handler(\Exception $exception);
    function display(\Exception $exception);
    function log(\Exception $exception);
}