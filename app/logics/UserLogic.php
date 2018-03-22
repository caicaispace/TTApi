<?php

namespace TTApiDemo\Logics;

use Library\Base\AbstractInterface\ALogic;
use Library\Base\AbstractInterface\ILogic;
use TTApiDemo\Models\Users as UserModel;

class UserLogic extends ALogic implements ILogic
{
    public function initialize()
    {
    }

    public function getList()
    {
        // TODO: Implement getList() method.
        return UserModel::find();
    }

    public function getInfo()
    {
        return UserModel::findFirst();
    }

    public function create()
    {
        // TODO: Implement create() method.
    }

    public function update()
    {
        // TODO: Implement update() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }
}