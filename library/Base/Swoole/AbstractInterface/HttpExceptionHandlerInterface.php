<?php

namespace Library\Base\Swoole\AbstractInterface;


use Library\Http\Request;
use Library\Http\Response;

interface HttpExceptionHandlerInterface
{
    function handler(\Exception $exception,Request $request , Response $response);
}