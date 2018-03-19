<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 20:32
 */

namespace Library\Base\AbstractInterface;


interface ILogic
{
    public function getList();
    public function getInfo();
    public function create();
    public function update();
    public function delete();
}