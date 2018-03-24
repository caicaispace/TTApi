<?php

namespace Library\Base\Phalcon;

use Phalcon\DI;
use Phalcon\DiInterface;
use Library\Utility\Functions;

trait TDi
{
    protected $di;

    /**
     * @param $name
     * @param array $params
     * @return bool|mixed
     */
    public static function di($name, $params = [])
    {
        try{
            $di = DI::getDefault()->get($name, [$params]);
        } catch (\Phalcon\Exception $e) {
            return false;
        }
        return $di;
    }

    /**
     * @param DiInterface $di
     */
    public function setDi(DiInterface $di)
    {
        $this->di = $di ? $di : DI::getDefault();
    }

    /**
     * @param null $name
     * @param array $params
     * @return bool|mixed|DiInterface
     */
    function getDi($name = null, $params = [])
    {
        if (null === $name) {
            return DI::getDefault();
        }
        return self::di($name, $params);
    }

    /**
     * @param null $key
     * @param null $defaultValue
     * @return bool|mixed
     */
    static function getConfig($key = null, $defaultValue = null)
    {
        $config = self::di('config');
        if (null === $key) {
            return $config;
        }
        $config = $config->toArray();
        return Functions::fnGet($config, $key, $defaultValue);
    }
}
