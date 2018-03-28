<?php

namespace Library\Component\Config;

use Phalcon\Config\Adapter\Json as ConfigJson;

class Json extends ConfigJson
{
    public function getByString($key,$defaultValue = null)
    {
        return TConfig::getByString($this, $key, $defaultValue);
    }
}