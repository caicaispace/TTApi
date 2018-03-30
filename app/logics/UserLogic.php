<?php

namespace App\Logics;

use Library\Base\Phalcon\AbstractInterface\ALogic;
use Library\Base\Phalcon\AbstractInterface\ILogic;
use App\Models\Users as UserModel;

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
        $rand = mt_rand(1000,9999);
        $user = new UserModel;
        $user->name = 'ttapi';
        $user->password = md5('password'.$rand);
        $user->email = 'ttapi@ttapi.com'.$rand;
        $user->username = 'ttapi demo'.$rand;
        $user->created_at = date('Y-m-d H:i:s');
        $user->active = UserModel::STATUS_ACTIVE;
        if (!$user->create()) {
            $messages = $user->getMessages();
            foreach ($messages as $message) {
                echo $message->getMessage();
            }
            return false;
        }
        return true;
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