<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace common\widgets;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7;
use Yii;

/**
 * Class YhtClient
 * @package Client
 * @author cwjackk
 */
class YhtClient extends \yii\base\Component
{
    public static $url = [
        'base'=>'https://api.yunhetong.com/api/',
        'token'=>'auth/login',
        'contract'=>[
            'list'=>'contract/list',
            'template'=>'contract/templateContract',
            'signer'=>'contract/signer',
            'sign'=>'contract/sign',
            'cz'=>'contract/cz',
            'upload'=>'/contract/fileContract'
        ],
        'user'=>[
            'addC'=>'user/company',
            'addP'=>'user/person',
            'addCM'=>'user/companyMoulage',
            'addPM'=>'user/personMoulage'
        ]
    ];
    public static $pos = ['jiafang','yifang'];//占位符定位
    public static $posKey = ['甲方','乙方'];//关键字定位
    public static $timeOut = 888;
    public static $hjzSignerId = 2064620;//超级管理员(公司)的signerId
    public static $verifyPhone = 1;//验证手机
    public static $cz = 1;//是否开启合同存证
    public static $tokenConf = [
        "appId"=>"2018070415294900020",
        "appKey"=>"kG1nwr4N"
//        "appId"=>"2018062817051800007",
//        "appKey"=>"wceNcK55gQE"
    ];
    /**
     * @var Client
     */
    private $client;

    /**
     * 实例化请求句柄
     */
    public function init()
    {
        $this->client = new Client([
            'base_uri' => self::$url['base'],
        ]);
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function initToken($signerId=null){
        if ($signerId){
            //用户长效令牌
            $userOpt = array_merge(self::$tokenConf,["signerId"=>$signerId]);
            $reqOpt = $this->getReqOption(0, $userOpt);
            $response = $this->client->post(self::$url['token'],$reqOpt);
            /*请求返回结果*/
            $token = $response->getHeader("token")[0]; //头部token
        }else{
            //平台长效命令, 判断token是否过期
            $tokenExist = array_key_exists('tokenInfo',$_SESSION)? $_SESSION['tokenInfo']:" ";
            if(!is_array($tokenExist) || (time()-$tokenExist['time']>self::$timeOut) ){
                //超时重新获取
                $reqOpt = $this->getReqOption(0, self::$tokenConf);
                $response = $this->client->post(self::$url['token'],$reqOpt);
                /*请求返回结果*/
                $token = $response->getHeader("token")[0]; //头部token
                $_SESSION['tokenInfo'] = ['token'=>$token,'time'=>time()];//使用session存储结果
            }else{
                $token = $_SESSION['tokenInfo']['token'];
            }
        }
        return $token;
    }

    /**
     * @param $type 0.token请求头  1.平台api请求头(平台自身的长效令牌) 2.用户api请求头(创建者对应的长效令牌)
     * @param null $opt
     * @return array
     */
    public function getReqOption($type, $opt=null){
        if($type==0){
            $reqOpt = [
                'headers'=>["content-type"=>"application/json;charset=UTF-8"],
                'body' => "row data",
                'json' => $opt
            ];
        }elseif ($type==1){
            $reqOpt = [
                'headers'=>["content-type"=>"application/json;charset=UTF-8",'token'=>$this->initToken()],
                'body' => "row data",
                'json' => $opt
            ];
        }elseif ($type==2){
            $signerId = $_SESSION['userinfo']['yht_signerId'];
            $reqOpt = [
                'headers'=>["content-type"=>"application/json;charset=UTF-8",'token'=>$this->initToken($signerId)],
                'body' => "row data",
                'json' => $opt
            ];
        }elseif ($type==3){
            $body = \GuzzleHttp\Psr7\stream_for($_FILES['contract']['tmp_name']);
            $reqOpt = [
                'headers'=>["content-type"=>"multipart/form-data;charset=UTF-8",'token'=>$this->initToken()],
                'body' => $body,
                'json' => $opt
            ];
        }else{
            $reqOpt = [
                'headers'=>["content-type"=>"application/json;charset=UTF-8"],
            ];
        }
        return $reqOpt;
    }

    /**
     * @param null $method
     * @param null $url
     * @param array|null $json
     * @param int $type token类型 1.平台 2.用户
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \yii\db\Exception
     */
    public function sendReq($method=null, $url=null,array $json=null, $type=1){
        $userInfo = $_SESSION['userinfo'];
        //日志 请求参数
        Yii::$app->db->createCommand()->insert('yii2_wx_yht_log',['user_id'=>$userInfo['user_id'],'username'=>$userInfo['username'],'action'=>'request','resource'=>$url,'content'=>json_encode($json),'created_at'=>date('Y-m-d H:i:s')])->execute();

        $reqHeader = $this->getReqOption($type, $json);
        $response = $this->client->request($method, $url, $reqHeader);
        $res = $response->getBody()->getContents();

        //日志 返回参数
        Yii::$app->db->createCommand()->insert('yii2_wx_yht_log',['user_id'=>$userInfo['user_id'],'username'=>$userInfo['username'],'action'=>'response','resource'=>$url,'content'=>$res,'created_at'=>date('Y-m-d H:i:s')])->execute();

        $respArr = json_decode($res,true);
        return $respArr;
    }
}
