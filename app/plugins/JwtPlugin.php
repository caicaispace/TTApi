<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/18
 * Time: 20:52
 */

namespace TTDemo\Plugins;

use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Firebase\JWT\JWT;

class JwtPlugin
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
        $key = "example_key";
        $token = array(
            "iss" => "http://ttapi.nginx",
            "aud" => "http://ttapi.nginx",
            "iat" => 1356999524,
            "nbf" => 1357000000
        );

        /**
         * IMPORTANT:
         * You must specify supported algorithms for your application. See
         * https://tools.ietf.org/html/draft-ietf-jose-json-web-algorithms-40
         * for a list of spec-compliant algorithms.
         */
        $jwt = JWT::encode($token, $key);
        var_dump($jwt);

        $decoded = JWT::decode($jwt, $key, array('HS256'));
        var_dump($decoded);

        /*
         NOTE: This will now be an object instead of an associative array. To get
         an associative array, you will need to cast it as such:
        */

        $decoded_array = (array) $decoded;

        /**
         * You can add a leeway to account for when there is a clock skew times between
         * the signing and verifying servers. It is recommended that this leeway should
         * not be bigger than a few minutes.
         *
         * Source: http://self-issued.info/docs/draft-ietf-oauth-json-web-token.html#nbfDef
         */
        JWT::$leeway = 60; // $leeway in seconds
        $decoded = JWT::decode($jwt, $key, array('HS256'));
    }
}