<?php

namespace Library\Swoole\Init;

use Phalcon\Loader;
use Phalcon\Events\EventsAwareInterface;

class AutoLoader extends Loader implements EventsAwareInterface
{
    protected static $instance;
    static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new static();
        }
        return self::$instance;
    }
}