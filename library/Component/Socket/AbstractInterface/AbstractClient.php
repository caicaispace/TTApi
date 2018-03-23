<?php

namespace Library\Component\Socket\AbstractInterface;


use Library\Component\Spl\SplBean;

abstract class AbstractClient extends SplBean
{
    protected $clientType;

    /**
     * @return mixed
     */
    public function getClientType()
    {
        return $this->clientType;
    }

    /**
     * @param mixed $clientType
     */
    public function setClientType($clientType)
    {
        $this->clientType = $clientType;
    }
}