<?php

namespace App;


use Core\AbstractInterface\AbstractRouter;
use Core\Component\Logger;
use Core\Http\Response;
use Phalcon\Mvc\Router as PhalconRouter;

class Router extends AbstractRouter
{

//    function register(RouteCollector $routeCollector)
//    {
//        // TODO: Implement addRouter() method.
//        $routeCollector->addRoute(['GET','POST'],"/router",function (){
//            $res = Response::getInstance();
//            $res->writeJson();
//            $res->end();
//        });
//        $routeCollector->addRoute("GET","/router2",'/test');
//    }

    function register(PhalconRouter $routeCollector)
    {
        $routeCollector->add('/:controller', [
            'controller' => 1,
            'action'     => 'index'
        ])->setName('front.controller');

//        // TODO: Implement addRouter() method.
//        $routeCollector->addRoute(['GET','POST'],"/router",function (){
//            $res = Response::getInstance();
//            $res->writeJson();
//            $res->end();
//        });
//        $routeCollector->addRoute("GET","/router2",'/test');
    }
}