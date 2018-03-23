<?php

namespace Library\Swoole\Pipe;


use Library\Swoole\Init\Server;

class Send
{
    static function send(Message $message, $workerId){
        return Server::getInstance()->getServer()->sendMessage($message->__toString(),$workerId);
    }
}