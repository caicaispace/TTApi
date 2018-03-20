<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/18
 * Time: 20:52
 */

namespace TTApiDemo\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Library\Utility\Random;
use Firebase\JWT\JWT;

class JWTPlugin
{
    /**
     * This action is executed before execute any action in the application
     *
     * @param Event $event
     * @param Dispatcher $dispatcher
     * @return bool
     */
    public function beforeDispatch(Event $event, Dispatcher $dispatcher)
    {

        return true;

        /**
         *
         *
         *  并发方案
         *
         * 1. 提前刷新 token
         *
         *
         * 一次性 token 验证方式
         *
         * 1. 并发量大黑名单验证，并发量小，白名单验证
         *
         *
         *
         */
        $key = Random::snowFlake();
        $key = "example_key";
        $token = array(
            "iss" => "http://ttapi.nginx",
            "aud" => "http://ttapi.nginx",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );

        $jwt = JWT::encode($token, $key);
        var_dump($jwt);

        $decoded = JWT::decode($jwt, $key, array('HS256'));
        var_dump((array)$decoded);
    }
}