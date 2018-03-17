<?php

namespace App\Model\WebSock;

use Core\Component\Socket\AbstractInterface\AbstractClient;
use Core\Component\Socket\AbstractInterface\AbstractCommandParser;
use Core\Component\Socket\Common\Command;

// 定义命令解析
class Parser extends AbstractCommandParser
{

    function parser(Command $result, AbstractClient $client, $rawData)
    {
        // TODO: Implement parser() method.
        //这里的解析规则是与客户端匹配的，等会请看客户端代码
        $js = json_decode($rawData, 1);
        if (is_array($js)) {
            if (isset($js['action'])) {
                $result->setCommand($js['action']);
            }
            if (isset($js['content'])) {
                $result->setMessage($js['content']);
            }
        }
    }
}
