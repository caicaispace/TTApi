<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 22:28
 */

namespace Library\Base\AbstractInterface;


interface IController
{
    public function listAction();
    public function infoAction();
    public function createAction();
    public function updateAction();
    public function deleteAction();
}