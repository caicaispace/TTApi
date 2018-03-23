<?php

namespace Library\Component\Socket;


use Library\Component\Socket\AbstractInterface\AbstractClient;
use Library\Component\Socket\AbstractInterface\AbstractCommandParser;
use Library\Component\Socket\AbstractInterface\AbstractCommandRegister;
use Library\Component\Socket\Client\TcpClient;
use Library\Component\Socket\Client\UdpClient;
use Library\Component\Socket\Common\Command;
use Library\Component\Socket\Common\CommandList;
use Library\Swoole\Init\Server;


class Dispatcher
{
    private static $instance;
    private $commandList;
    private $commandParser;
    static function getInstance($commandRegisterClass,$commandParserClass){
        if(!isset(self::$instance)){
            self::$instance = new Dispatcher($commandRegisterClass,$commandParserClass);
        }
        return self::$instance;
    }

    function __construct($commandRegisterClass,$commandParserClass)
    {
        $this->commandList = new CommandList();
        $commandRegister = new $commandRegisterClass();
        if($commandRegister instanceof AbstractCommandRegister){
            $commandRegister->register($this->commandList);
        }
        $this->commandParser  = new $commandParserClass();
    }

    function dispatchTCP($fd,$reactorId,$data){
        $client = new TcpClient(Server::getInstance()->getServer()->connection_info($fd));
        $client->setReactorId($reactorId);
        $client->setFd($fd);
        $this->run($client,$data);
    }

    function dispatchUDP($data,$clientInfo){
        $client = new UdpClient($clientInfo);
        $this->run($client,$data);
    }

    function dispatchWEBSOCK(\swoole_websocket_frame $frame){
        $client = new TcpClient(Server::getInstance()->getServer()->connection_info($frame->fd));
        $client->setFd($frame->fd);
        $this->run($client,$frame->data);
    }

    private function run(AbstractClient $client,$data){
        if($this->commandParser instanceof AbstractCommandParser){
            $command = new Command();
            $this->commandParser->parser($command,$client,$data);
            $handler = $this->commandList->getHandler($command);
            if(is_callable($handler)){
                try{
                    $ret = call_user_func_array($handler,array(
                        $command,$client
                    ));
                    if($ret !== null){
                        Response::response($client,(string)$ret);
                    }
                }catch (\Exception $exception){
                    trigger_error($exception->getTraceAsString());
                }
            }
        }
    }
}