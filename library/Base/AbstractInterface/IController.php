<?php

namespace Library\Base\AbstractInterface;


interface IController
{
    public function listAction();
    public function infoAction();
    public function createAction();
    public function updateAction();
    public function deleteAction();
}