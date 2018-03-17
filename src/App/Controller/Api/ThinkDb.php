<?php
namespace App\Controller\Api;

use Core\AbstractInterface\AbstractController;
use Core\Http\Message\Status;
use Core\Utility\Random;
use App\Model\Goods;

class ThinkDb extends AbstractController
{
    function index()
    {
        $res = Goods::get(1);
        $this->response()->write($res);
    }

    function getList()
    {
        $list = Goods::order('id', 'desc')->select();
        $this->response()->write($list);
    }

    function add()
    {
        $data = [
            'goods_name' => Random::randStr(10),
        ];
        $model = new Goods;
        $res = $model->data($data)->save();
        $this->response()->write($model->id);
    }

    function afterAction()
    {
        // TODO: Implement afterAction() method.
    }

    function onRequest($actionName)
    {
        // TODO: Implement onRequest() method.
    }

    function actionNotFound($actionName = null, $arguments = null)
    {
        // TODO: Implement actionNotFount() method.
        $this->response()->withStatus(Status::CODE_NOT_FOUND);
    }

    function afterResponse()
    {
        // TODO: Implement afterResponse() method.
    }
}
