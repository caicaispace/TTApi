<?php
namespace App\Controller\Api;

use Core\AbstractInterface\AbstractController;
use Core\Http\Message\Status;
use App\Model\Goods\Bean;
use App\Model\Goods\Goods as GoodsModel;
use Core\Utility\Random;

class Goods extends AbstractController
{

    function index()
    {
        // TODO: Implement index() method.
        $this->response()->write("this is api index");/*  url:domain/api/index.html  domain/api/  */
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

    function getList()
    {
        $goodsModel = new GoodsModel;
        $data = $goodsModel->getList();
        $this->response()->write($data);
    }

    function getOne()
    {
        $goodsModel = new GoodsModel;
        $data = $goodsModel->getOne(1);
        $this->response()->write($data);
    }

    function add()
    {
        $goodsBean = new Bean([
            'goods_id' => \mt_rand(100000000, 999999999),
            'goods_name' => Random::randStr(10),
        ]);
        $goodsModel = new GoodsModel;
        try {
            $res = $goodsModel->add($goodsBean);
        } catch (\Exception $e) {
            $res = $e->getMessage();
        }
        $this->response()->writeJson(Status::CODE_OK,$res,'操作成功');
    }
}
