<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 20:32
 */
namespace Library\Base\AbstractInterface;

use Core\Component\Di;

abstract class AService
{
    protected $model;

    function __construct()
    {
    }

    public function getModel()
    {
    }
}