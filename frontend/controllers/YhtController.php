<?php

namespace frontend\controllers;
use Yii;
use yii\helpers\ArrayHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use common\models\WxYhtContract;

class YhtController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'yhtmain';

    /**
     * @return string
     * TODO 添加访问权限
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

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

    public function actionContract()
    {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://api.yunhetong.com/api/',
        ]);
        $token = $this->runAction('token',['runAction'=>1]);
        $response = $client->get("contract/list/1/1807261536209921/0/1/10",[
            'headers'=>["content-type"=>"application/json;charset=UTF-8","token"=>$token],
        ]);
//        p(Psr7\str($response));
        $res = $response->getBody()->getContents();
        $respBody = json_decode($res,true);
//        p($respBody,1);
        if (Yii::$app->request->isAjax){
//            $contractId = number_format($respBody['data']['contractList'][0]['id'],0,'','');
            $contractId = "1807261536209921";
            \common\helpers\FuncHelper::ajaxReturn(200,'success', $contractId);
        }
    }

    public function actionContractDetail($tid){
        // 超管点击进入查看合同, 没有空置合同? (是)创建新空置合同 (否)用空置合同   展示空置合同
        return $this->render('contract-detail');die;
        //1.查数据库
        $exist = WxYhtContract::findOne(["cont_templateId"=>$tid,"cont_has_signer"=>0]);
        if (empty($exist)){
            //创建合同
            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'https://api.yunhetong.com/api/',
            ]);
            $token = $this->runAction('token',['runAction'=>1]);//平台token
            $response = $client->post("contract/templateContract",[
                'headers'=>["content-type"=>"application/json;charset=UTF-8","token"=>$token],
                'body' => "row data",
                'json'=>[
                    "contractTitle"=>"荟家装云合同",
                    "templateId"=>"TEM1003301",
                    "contractData"=>[
                        '${name}'=>"大东",
                        '${mobile}'=>"13726449403",
                        '${id_no}'=>"sadfasdf18294903",
                        '${corporate_name}'=>"深圳荟家装科技有限公司",
                        '${business_licence}'=>"ASDFGHJKL001",
                        '${product_name}'=>"创客模式合同",
                        '${contract_date}'=>"2018-7-26"
                    ]
                ]
            ]);
            $res = $response->getBody()->getContents();
            $respBody = json_decode($res,true);

            //写库
            $contract = [
                "cont_templateId"=>$tid,
                "cont_contractId"=>$respBody["data"]["contractId"],
                "cont_created_time"=>date("Y-m-d H:i:s")
            ];
            Yii::$app->db->createCommand()->insert("yii2_wx_yht_contract",$contract)->execute();
            $contractId = $respBody["data"]["contractId"];
        }else{
            $contractId = $exist['cont_contractId'];
        }
        //2. 获取合同号返给前端
//        \common\helpers\FuncHelper::ajaxReturn(200,'success', $contractId);

    }
}
