<?php

namespace Library\Base\Phalcon;

use Phalcon\DI;
use Phalcon\DiInterface;
use Library\Utility\Functions;

trait TDi
{
    protected $di;

    /**
     * @return DiInterface
     */
    public function di()
    {
        return $this->di ? $this->di : DI::getDefault();
    }

    /**
     * @param DiInterface $di
     */
    public function setDi(DiInterface $di)
    {
        $this->di = $di ? $di : DI::getDefault();
    }

    /**
     * @return DiInterface
     */
    public function getDi()
    {
        return $this->di();
    }

    /**
     * @param null $key
     * @param null $defaultValue
     * @return bool|mixed
     */
    public function getConfig($key = null, $defaultValue = null)
    {
        $config = $this->di()->getShared('config');
        if (null === $key) {
            return $config;
        }
        $config = $config->toArray();
        return Functions::fnGet($config, $key, $defaultValue);
    }
}
