<?php
namespace App\Service;


use Base\AbstractInterface\AbstractService;

class Goods extends AbstractService
{
    function getModel()
    {
        return $this->model;
    }
}
