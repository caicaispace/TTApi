<?php

namespace Library\Base\Phalcon\AbstractInterface;


interface ILogic
{
    public function getList();
    public function getInfo();
    public function create();
    public function update();
    public function delete();
}