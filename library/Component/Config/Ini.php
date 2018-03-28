<?php

namespace Library\Component\Config;

use Phalcon\Config\Adapter\Ini as ConfigIni;

class Ini extends ConfigIni
{
    public function getByString($key,$defaultValue = null)
    {
        return TConfig::getByString($this, $key, $defaultValue);
    }
}