<?php

namespace TTDemo\Controllers;

use TTDemo\Models\Users;
use Phalcon\Http\Request;
/**
 * SessionController
 *
 * Allows to authenticate users
 */
class SessionController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('Sign Up/Sign In');
        parent::initialize();
    }

    public function indexAction()
    {
        if (!$this->request->isPost()) {
            $this->tag->setDefault('email', 'demo@phalconphp.com');
            $this->tag->setDefault('password', 'phalcon');
        }
    }

    /**
     * Register an authenticated user into session data
     *
     * @param Users $user
     */
    private function registerSession(Users $user)
    {
        $this->session->set('auth', [
            'id'   => $user->id,
            'name' => $user->name
        ]);
    }

    /**
     * This action authenticate and logs an user into the application
     */
    public function startAction()
    {
//        var_export($this->request->getServer());
//        var_export($_SERVER);
//        header('Content-type: application/json');
//        $arr = [
//            '$_COOKIE' => $_COOKIE,
//            '$_ENV' => $_ENV,
//            '$_FILES' => $_FILES,
//            '$_GET' => $_GET,
//            '$_POST' => $_POST,
////            '$_SESSION' => $_SESSION,
//            '$_REQUEST' => $_REQUEST,
//            '$_SERVER' => $_SERVER,
//        ];
//        return \json_encode($arr,JSON_UNESCAPED_UNICODE);
//        die;
        if ($this->request->isPost()) {
            $email    = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            /** @var Users $user */
            $user = Users::findFirst(array(
                "(email = :email: OR username = :email:) AND password = :password: AND active = 'Y'",
                'bind' => ['email' => $email, 'password' => sha1($password)]
            ));
            if ($user != false) {
                $this->registerSession($user);
                $this->flash->success('Welcome ' . $user->name);
                return $this->forward('invoices/index');
            }
            $this->flash->error('Wrong email/password');
        }
        return $this->forward('session/index');
    }

    /**
     * Finishes the active session redirecting to the index
     */
    public function endAction()
    {
        if ($auth = $this->session->get('auth')) {
            $user = Users::findFirstById($auth['id']);

            $name = $user ? $user->name : '';
            $this->flash->success("Goodbye {$name}!");

            $this->session->remove('auth');
        }

        return $this->forward('index/index');
    }
}
