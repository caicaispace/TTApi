<?php

namespace Library\Component\RPC\Common;


use Library\Component\RPC\AbstractInterface\AbstractPackageParser;
use Library\Component\Socket\Client\TcpClient;

class DefaultPackageParser extends AbstractPackageParser
{
    function decode(Package $result, TcpClient $client, $rawData)
    {
        // TODO: Implement decode() method.
        $rawData = pack('H*', base_convert($rawData, 2, 16));
        $js = json_decode($rawData,1);
        $js = is_array($js) ? $js :[];
        $result->arrayToBean($js);
    }

    function encode(Package $res)
    {
        // TODO: Implement encode() method.
        $data = $res->__toString();
        $value = unpack('H*', $data);
        return base_convert($value[1], 16, 2);
    }

}