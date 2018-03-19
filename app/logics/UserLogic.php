<?php
/**
 * Created by PhpStorm.
 * User: safer
 * Date: 2018/3/19
 * Time: 20:16
 */

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