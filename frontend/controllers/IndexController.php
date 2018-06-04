<?php

namespace frontend\controllers;
use Yii;
use yii\web\Controller;

class IndexController extends Controller
{
    /**
     * @var string
     */
    //public $layout = 'main1';
    public $layout = false;

//    public function actionIndex()
//    {
//        return $this->render('index');
//    }

        public function actionIndex()
    {
        $response = Yii::$app->wechat->server->serve();
        // 将响应输出
        $response->send();
        // 微信网页授权:
//        if(Yii::$app->wechat->isWechat && !Yii::$app->wechat->isAuthorized()) {
//            return Yii::$app->wechat->authorizeRequired()->send();
//        }
//        return $this->render('wxKanjia');

    }

    public function actionArticle()
    {
        p('helloWrold');
    }
}
