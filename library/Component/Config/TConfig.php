<?php

namespace Library\Component\Config;

use Phalcon\Config;
use Library\Utility\Functions;

trait TConfig
{
    static function getByString(Config $config, $key,$defaultValue = null)
    {
        $config = $config->toArray();
        return Functions::fnGet($config, $key, $defaultValue);
    }
}