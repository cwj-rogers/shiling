<?php

namespace frontend\controllers;
use Yii;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

class TestController extends \yii\web\Controller
{
    public function behaviors()
    {
        return ArrayHelper::merge([
            'corsFilter' => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD', 'OPTIONS'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => null,
                    'Access-Control-Max-Age' => 86400,
                    'Access-Control-Expose-Headers' => [],
                ],
            ],
        ], parent::behaviors());
    }

    public function actionIndex()
    {
        $this->layout = false;
//        Yii::$app->response->headers->add("Access-Control-Allow-Origin", "*");
        header("Access-Control-Allow-Origin：*");
        return $this->render('index');
    }

    public function actionToken()
    {
        
    }
}
