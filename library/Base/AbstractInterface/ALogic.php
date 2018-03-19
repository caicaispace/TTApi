<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 20:25
 */

namespace Library\Base\AbstractInterface;

use Phalcon\Mvc\Model;

abstract class ALogic
{
    protected $model;

    public function __construct(Model $model = NULL)
    {
        if (NULL !== $model) {
            $this->setModel($model);
        }
        if (method_exists($this, "initialize")) {
            $this->initialize();
        }
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function getModel()
    {
        return $this->model;
    }
}