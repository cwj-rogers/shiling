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

    /**
     * @param null $runAction
     * @return mixed
     */
    public function actionToken($runAction=null)
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.yunhetong.com/api/',
            // You can set any number of default request options.
//            'timeout'  => 2.0,
        ]);
        //判断token是否过期
        $tokenExist = array_key_exists('tokenInfo',$_SESSION)? $_SESSION['tokenInfo']:" ";
        if(!is_array($tokenExist) || (time()-$tokenExist['time']>0) ){
            //超时重新获取
            try{
                $response = $client->post('auth/login',[
                    'headers'=>["content-type"=>"application/json;charset=UTF-8","Accept"=>"application/json"],
                    'body' => "row data",
                    'json'=>["appId"=>"2018062817051800007","appKey"=>"wceNcK55gQE"]
                ]);
//            p($response->getHeader("token"));
//            p(Psr7\str($response));//完整显示返回信息

                $token = $response->getHeader("token")[0];
                $_SESSION['tokenInfo'] = ['token'=>$token,'time'=>time()];//使用session存储结果
            }catch (RequestException $e){
                p($e->getRequest());
                if ($e->hasResponse()) {
                    p(Psr7\str($e->getResponse()));
                }
            }
        }else{
            $token = $_SESSION['tokenInfo']['token'];
        }
        if (Yii::$app->request->isAjax && !$runAction){
            \common\helpers\FuncHelper::ajaxReturn(200,'success', $token);
        }else{
            return $token;
        }
    }

    /**
     * 异步获取
     * @throws \yii\base\InvalidRouteException
     */
    public function actionContract()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.yunhetong.com/api/',
        ]);
        $token = $this->runAction('token',['runAction'=>1]);
        $response = $client->get("contract/list/1/2018062817051800007/0/1/10",[
            'headers'=>["content-type"=>"application/json;charset=UTF-8","token"=>$token],
        ]);
//        p(Psr7\str($response));
        $res = $response->getBody()->getContents();
        $respBody = json_decode($res,true);
//        p($respBody);
        if (Yii::$app->request->isAjax){
//            $contractId = number_format($respBody['data']['contractList'][0]['id'],0,'','');
            $contractId = "1807181018464293";
            \common\helpers\FuncHelper::ajaxReturn(200,'success', $contractId);
        }
    }
}
