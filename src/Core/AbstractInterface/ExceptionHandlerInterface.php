<?php

namespace Core\AbstractInterface;


interface ExceptionHandlerInterface
{
    function handler(\Exception $exception);
    function display(\Exception $exception);
    function log(\Exception $exception);
}