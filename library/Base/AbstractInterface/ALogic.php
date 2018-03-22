<?php

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