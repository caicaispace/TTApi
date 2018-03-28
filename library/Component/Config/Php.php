<?php

namespace Library\Component\Config;

use Phalcon\Config\Adapter\Php as ConfigPhp;

class Php extends ConfigPhp
{
    public function getByString($key,$defaultValue = null)
    {
        return TConfig::getByString($this, $key, $defaultValue);
    }
}