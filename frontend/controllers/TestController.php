<?php

namespace frontend\controllers;
use Yii;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;

class TestController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
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
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.yunhetong.com/api/',
            // You can set any number of default request options.
//            'timeout'  => 2.0,
            'verify' => false
        ]);
        $params = [
            'appId' => '20180628170518000017',
            'appKey' => 'wceNcK55gQE'
        ];
        $options = json_encode($params, JSON_UNESCAPED_UNICODE);

        try{
            $response = $client->post('auth/login',[
                'headers'=>["content-type"=>"application/json;charset=UTF-8","Accept"=>"application/json"],
//                'body' => $options,
                'json'=>["appId"=>"20180628170518000017","appKey"=>"wceNcK55gQE"]
            ]);
            
            p($response);
            p($response->getHeaderLine("token"));
//            p($response->getStatusCode());
        }catch (RequestException $e){
            echo Psr7\str($e->getRequest());
            if ($e->hasResponse()) {
                echo Psr7\str($e->getResponse());
            }
        }

//        if (Yii::$app->request->isAjax){
//            \common\helpers\FuncHelper::ajaxReturn(200,'success',"eyJhbGciOiJIUzUxMiJ9.eyJleHAiOjE1MzIzMTkwMjYsImp0aSI6ImJHQktsYzZnSlJzNGdRcWw2SkhzbGRvb1QvbmVTcjVYYVR0TEQ0TGswbEpwbk5yeHEvYVY4TDVia0VQY051QzQyTlZicWhzKzByUjVHeDV6WGZ3N2d3PT0ifQ.vEG0KZBL9WL1is_MUn03kBhLojGuDIOMll2rPTHirygSMW-PdtSbljVL5OprjJDeN0Nyb82aRuE0AcA4Ib7KcQ");
//        }

    }

    public function actionContract()
    {
        if (Yii::$app->request->isAjax){
            \common\helpers\FuncHelper::ajaxReturn(200,'success',"1807021639542453");
        }

    }
}
