<?php

namespace Core\AbstractInterface;


use Core\Http\Request;
//use Core\Http\Response;
use Library\Http\Response;

interface HttpExceptionHandlerInterface
{
    function handler(\Exception $exception,Request $request , Response $response);
}