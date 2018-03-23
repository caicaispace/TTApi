<?php

namespace Library\Component\RPC\Client;


use Library\Component\RPC\Common\Package;

class CallList
{
    private $taskList = [];
    function addCall($serverName,$action,array $args = null,callable $successCall = null,callable $failCall = null){
        $package = new Package();
        $package->setServerName($serverName);
        $package->setAction($action);
        $package->setArgs($args);
        $this->taskList[] = new Call($package,$successCall,$failCall);
        return $this;
    }

    function getTaskList(){
        return $this->taskList;
    }
}