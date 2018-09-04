<?php

namespace frontend\controllers;
use yii\helpers\Url;
use Yii;
use yii\helpers\ArrayHelper;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7;
use common\models\WxYhtContract;
use common\models\WxYhtInfo;
use common\widgets\YhtClient;
use common\helpers\FuncHelper as output;
use common\models\WxUser;
use yii\db\Expression;
use yii\db\Query;

class YhtController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'yhtmain';

    function init()
    {
        //是否在微信端打开
//        if (!Yii::$app->wechat->isWechat){
//            return Yii::$app->wechat->oauth->redirect()->send();
//        }
        //是否开启session
        if (!Yii::$app->session->isActive){
            Yii::$app->session->open();
        }
        //平台验证和授权验证
        if (Yii::$app->wechat->isWechat && !Yii::$app->wechat->isAuthorized()){
            return Yii::$app->wechat->authorizeRequired()->send();
        }
        //用户是否存在
        if(Yii::$app->wechat->isWechat && !Yii::$app->session->has("userinfo") && Yii::$app->wechat->isAuthorized()){
            (new WxUser)->createUser();
        }
        parent::init(); // TODO: Change the autogenerated stub
    }

    /**
     * @param $action
     * @return bool|\yii\web\Response
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {
        //判断访问的客户端, 非微信用户跳转到web统一登录口
        if(!Yii::$app->wechat->isWechat && !Yii::$app->session->has("userinfo")){
            //添加不作验证的地址特例
            $webLoginUrl = Url::toRoute(['yht-login/web'],true);
            $_SERVER['accessUrl'] = Yii::$app->request->getAbsoluteUrl();
            return $this->redirect($webLoginUrl)->send();
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }

    /**
     * 我的合同列表
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        if(!isset($_SESSION['userinfo']) || !isset($_SESSION['userinfo']['user_id'])){
            return $this->refresh();
        }
        //1.获取用户信息
        $userId = $_SESSION['userinfo']['user_id'];
        $yhtInfo = WxYhtInfo::findOne(['user_id'=>$userId]);
        //2.1 用户是否存在
        if (!empty($yhtInfo)){
            //保存信息到session
            $_SESSION['userinfo']['yht_signerId'] = $yhtInfo->yht_signerId;
            $_SESSION['userinfo']['yht_username'] = $yhtInfo->yht_username;
            $_SESSION['userinfo']['yht_authority'] = $yhtInfo->yht_authority;

            $authority = $yhtInfo->yht_authority;
            if (0){
                //超级管理员,从接口获取数据
                $client = new YhtClient();
                $appId = YhtClient::$tokenConf['appId'];//应用id
                $url = "contract/list/1/{$appId}/0/1/10";//类型 0个人,1.公司 id 状态 页数 条数
                try{
                    $contrachInfo = $client->sendReq('get',$url);
                    $res = $contrachInfo['data']['contractList'];
                    foreach ($res as $k=>$v){
                        $res[$k]['gmtCreate'] = date("Y-m-d",strtotime($v['gmtCreate']));
                    }
                }catch (GuzzleException $e){
                    Yii::error($e->getMessage());
                    $res = [];
                }
            }else{
                $offset = Yii::$app->request->get("offset",0);
                $limit = Yii::$app->request->isAjax? 5:10;
                //普通管理员,普通用户 查数据库
                $query = new Query();
                $contrachIds = $query->from('yii2_wx_yht_contract_signer')
                    ->select("contract_id")
                    ->where(['user_id'=>$yhtInfo->user_id])
                    ->column();

                $res = $query->from('yii2_wx_yht_contract')
                    ->select("cont_owner_signerId as signerId,cont_contractId as contractNo,cont_title as title,cont_created_time as gmtCreate,cont_status as status")
                    ->where(['cont_contractId'=>$contrachIds])
                    ->andWhere(['cont_is_del'=>0])
                    ->offset($offset)->limit($limit)
                    ->orderBy("cont_created_time desc")
                    ->all();
                if (!empty($res)){
                    foreach ($res as $k=>$v){
                        $res[$k]['gmtCreate'] = date("Y-m-d",strtotime($v['gmtCreate']));
                    }
                }else{
                    $res = [];
                }
            }
        }else{
            $res = [];
        }
        if (Yii::$app->request->isAjax){
            output::ajaxReturn(200,'success',['list'=>$res]);
        }
        return $this->render('index',['list'=>$res,'authority'=>isset($authority)? $authority:3]);
    }

    /**
     * 获取应用token，获取用户token
     * @param null $signerId
     */
    public function actionToken($signerId=null)
    {
        if (Yii::$app->request->isAjax){
            $client = new YhtClient();
            try{
                $token = $client->initToken();
            }catch (RequestException $e){
                output::ajaxReturn(400, Psr7\str($e->getResponse()));
            }
            output::ajaxReturn(200,'success', $token);
        }
    }

    /**
     * 模板选择页
     * @return string|\yii\web\Response
     */
    public function actionTemplate(){
        if(!isset($_SESSION['userinfo']) || !isset($_SESSION['userinfo']['user_id'])){
            return $this->refresh();
        }
        $query = new Query();
        $tmpList = $query->from('yii2_wx_yht_template')
            ->where(["is_show"=>1])
            ->orderBy("tmp_id desc")
            ->all();
        $authority = $_SESSION['userinfo']['yht_authority'];
        return $this->render('tmp',['list'=>$tmpList,'authority'=>$authority]);
    }

    /**
     * 模板信息填写页
     * @param $tid
     * @param $formName
     * @param $tmp_name
     * @return string
     */
    public function actionTemplateForm($tid,$formName,$tmp_name){
        //是否有空置还可用的合同
        $signerId = $_SESSION['userinfo']['yht_signerId'];
        $contractInfo = WxYhtContract::findOne(['cont_templateId'=>$tid,'cont_owner_signerId'=>$signerId,'cont_has_bind'=>0,'cont_status'=>0]);
        if (empty($contractInfo)){
            return $this->render($formName,['tid'=>$tid,'tmp_name'=>$tmp_name]);
        }else{
            return $this->redirect(['yht/contract-create','contractId'=>$contractInfo->cont_contractId]);
        }
    }

    /**
     * 超级管理员创建可分享合同
     * @param null $tid
     * @return string|\yii\web\Response
     * @throws GuzzleException
     * @throws \yii\db\Exception
     * TODO 完善模板列表 理顺合同创建逻辑
     */
    public function actionContractCreate($tid=null, $tmp_name=null, $contractId=null){
        if(!isset($_SESSION['userinfo']) || !isset($_SESSION['userinfo']['user_id'])){
            return $this->refresh();
        }
        $signerId = $_SESSION['userinfo']['yht_signerId'];
        //获取post资料，创建新合同
        if (Yii::$app->request->isPost && $contractId==null){
            //判断角色 1.平台 2.管理员  合同表必须带有判断类型字段type,合同创建者id,模板id这些搜索字段

            $authority = $_SESSION['userinfo']['yht_authority'];
            $client = new YhtClient();
            //处理提交的表单信息
            if(empty($_POST)){
                return $this->render('fail',['msg'=>'提交信息不能为空']);
            }
            //把提交数组整理成对应格式
            /**
                [
                    [${name1}] => 深圳市荟家装科技有限公司
                    [${name2}] => 得力装饰公司
                    [${money}] => 10
                    [${area}] => 禅城区
                    [${shop}] => 智慧新城
                ]
             **/
            $reqInfo = [];
            foreach ($_POST as $k=>$v){
                if(empty($v) && $k!="other"){
                    return $this->render('fail',['msg'=>"请提交完整的资料"]);
                }
                $key = '${'.$k.'}';
                $reqInfo[$key] = $v;
            }
            $tmpJson = [
                "contractTitle"=>$tmp_name,
                "templateId"=>$tid,
                "contractData"=>$reqInfo
            ];
            if ($authority==1 || $authority==2){
                //超级管理员创建(平台)
                $repInfo = $client->sendReq('post',YhtClient::$url['contract']['template'],$tmpJson);
                //管理员(个人)
                //$repInfo = $client->sendReq('post',YhtClient::$url['contract']['template'],$tmpJson,2);
            }else{
                return $this->render('fail',['msg'=>"用户没有权限"]);
            }
            $db = Yii::$app->db;
            try{
                if ($repInfo['code']!=200){
                    return $this->render('fail',['msg'=>$repInfo['msg']]);
                }
                $trans = $db->beginTransaction();
                // 1.获取新创建云合同ID 2.合同表记录入库
                $contractId = number_format($repInfo["data"]["contractId"],0,'','');// 解决返回数据变成科学计数法的bug

                $db->createCommand()->insert('yii2_wx_yht_contract',
                    [
                        'cont_contractId'=>$contractId,
                        'cont_owner_signerId'=>$signerId,
                        'cont_templateId'=>$tid,
                        'cont_title'=>$tmp_name,
                        'cont_created_time'=>date("Y-m-d H:i:s")
                    ])->execute();
                //云用户和合同关联表
                $db->createCommand()->insert('yii2_wx_yht_contract_signer',
                    [
                        'contract_id'=>$contractId,
                        'signer_id'=>$signerId,
                        'user_id'=>$_SESSION['userinfo']['user_id'],
                        'is_owner'=>1,
                        'created_at'=>date("Y-m-d H:i:s")
                    ])->execute();
                //签约负责人创建数量
                $db->createCommand()->update('yii2_wx_yht_info',["yht_create_contract_num"=>new Expression("`yht_create_contract_num`+1")])->execute();
                //添加甲方签署人(荟家装)
                $hjzSignerId = YhtClient::$hjzSignerId;
                $signerInfo = [
                    "signerId" => $hjzSignerId,//签署者 id
                    "signPositionType" => 1,//签署的定位方式：0 关键字定位，1 签名占位符定位，2 签署坐标
                    "positionContent" => YhtClient::$pos[0],//对应定位方式的内容，如果用签名占位符定位可以传多个签名占位符，并以分号隔开,最多 20 个;如果用签署坐标定位，则该参数包含三个信息：“页面,x 轴坐标,y 轴坐标”（如 20,30,49）
                    "signValidateType" => 0//签署验证方式：0 不校验，1 短信验证
                ];
                $signRes = $client->sendReq('post',YhtClient::$url['contract']['signer'],["idType"=>0,"idContent"=>$contractId,"signers"=>[$signerInfo] ]);
                if ($signRes['code']!=200){
                    throw new \yii\db\Exception($signRes['msg']);
                }else{
                    $trans->commit();
                    return $this->redirect(['yht/contract-create','contractId'=>$contractId]);
                }
            }catch (\yii\db\Exception $e){
                $trans->rollBack();
                return $this->render('fail',['msg'=>$e->getMessage()]);
            }
        }else{
            //判断是否为合同创建者访问
            $isOwn = WxYhtContract::findOne(['cont_contractId'=>$contractId,'cont_owner_signerId'=>$signerId]);
            if (!empty($isOwn)){
                return $this->render('contract-create',['contractId'=>$contractId,'contTitle'=>$isOwn->cont_title]);
            }else{
                // 防止其他人进入
                return $this->redirect(['yht/contract-detail','contractId'=>$contractId]);
            }
        }
    }

    /**
     * 合同分享成功, 异步锁定
     * @param $contractId
     * @throws \yii\db\Exception
     */
    public function actionContractLock($contractId){
        if (Yii::$app->request->isAjax){
            Yii::$app->db->createCommand()->update('yii2_wx_yht_contract',['cont_has_bind'=>1],['cont_contractId'=>$contractId])->execute();
            output::ajaxReturn(200);
        }
    }


    /**
     * 合同详情
     * @param $contractId
     * @return string|\yii\web\Response
     * @throws \yii\db\Exception
     */
    public function actionContractDetail($contractId){
        if(!isset($_SESSION['userinfo']) || !isset($_SESSION['userinfo']['user_id'])){
            return $this->refresh();
        }
        //1.获取用户信息
        $userId = $_SESSION['userinfo']['user_id'];
        $yhtInfo = WxYhtInfo::findOne(['user_id'=>$userId]);
        //2.1 用户是否存在
        if (!empty($yhtInfo)) {
            //保存信息到session
            $_SESSION['userinfo']['yht_signerId'] = $yhtInfo->yht_signerId;
            $_SESSION['userinfo']['yht_username'] = $yhtInfo->yht_username;
            $_SESSION['userinfo']['yht_authority'] = $yhtInfo->yht_authority;
        }

        //1.查数据库, 查出订单
        $contractInfo = WxYhtContract::findOne(["cont_contractId"=>$contractId]);
        $signerId = array_key_exists('yht_signerId',$_SESSION['userinfo'])? $_SESSION['userinfo']['yht_signerId']:0;
        if (!empty($contractInfo)){
            if ($contractInfo['cont_has_bind']==2){
                //锁定的合同, 需要访问权限判断, 只有创建人和签署人能看到合同内容
                try{
                    $exist = Yii::$app->db->createCommand("select * from yii2_wx_yht_contract_signer where contract_id={$contractId} and user_id={$userId}")->queryOne();
                    if (empty($exist)){
                        return $this->render('fail',['msg'=>"抱歉! 40012非合同签署双方不能查看合同"]);
                    }
                }catch (\yii\db\Exception $e){
                    return $this->render('fail',['msg'=>"抱歉! 40013系统出错,请刷新再试"]);
                }
            }
            $status = $contractInfo->cont_status;//合同状态
            //用户身份
            if ($contractInfo->cont_owner_signerId == $signerId){
                $isGuest = 0;
            }else{
                $isGuest = 1;
            }
            $authority = isset($yhtInfo->yht_authority)? $yhtInfo->yht_authority:3;
            return $this->render('contract-detail',['contractId'=>$contractId,'status'=>$status,'isGuest'=>$isGuest,'authority'=>$authority,'contTitle'=>$contractInfo->cont_title]);
        }else{
            //p("抱歉你所查看的合同不存在",1);
            return $this->render('fail',['msg'=>"抱歉! 40011你所查看的合同不存在"]);
        }
    }

    /**
     * 判断用户云平台账号是否存在
     */
    public function actionSign(){
        //1.查是否有云平台信息
        $userId = $_SESSION['userinfo']['user_id'];
        $res = WxYhtInfo::findOne(['user_id'=>$userId]);
        if (!empty($res)){
            output::ajaxReturn(200,'success',['moulageId'=>$res->yht_moulageId]);
        }else{
            output::ajaxReturn(201,'账号未实名认证');
        }
    }

    /**
     *  新用户注册为云合同用户
     * @throws \yii\db\Exception
     */
    public function actionCreateUser(){
        if(Yii::$app->request->isAjax){
            list($username, $certifyNum, $phoneNo, $type) = array_values(Yii::$app->request->get());//取参数
            $yhtClient = new YhtClient();
            try{
                if ($type==1){
                    $res = $yhtClient->sendReq('post',YhtClient::$url['user']['addP'],[
                        "userName"=>$username,
                        "identityRegion" => "0",
                        "certifyNum" => $certifyNum,
                        "phoneRegion" => "0",
                        "phoneNo" => $phoneNo,
                        "caType" => "B2"
                    ]);
                }elseif ($type==2){
                    $res = $yhtClient->sendReq('post',YhtClient::$url['user']['addC'],[
                        "userName"=>$username,
                        "certifyType" => "1",
                        "certifyNum" => $certifyNum,
                        "phoneNo" => $phoneNo,
                        "caType" => "B2"
                    ]);
                }else{
                    output::ajaxReturn(201,'用户角色获取失败');
                }

                if ($res['code']==200){
                    $signerId = $res['data']['signerId'];//返回用户id
                    $_SESSION['userinfo']['yht_signerId'] = $signerId;//保存到session
                    $_SESSION['userinfo']['yht_username'] = $username;
                    $_SESSION['userinfo']['yht_authority'] = 3;

                    //创建印模
                    $urlMoulage = $type==1? YhtClient::$url['user']['addPM']:YhtClient::$url['user']['addCM'];
                    $resMoulage = $yhtClient->sendReq('post',$urlMoulage,[
                        "signerId"=>$signerId
                    ]);
                    $moulageId = $resMoulage['code']==200? $resMoulage['data']['moulageId']:"";//印模id

                    //创建用户，入库(yii2_wx_user,yii2_wx_yht_info)
                    $inData = [
                        'user_id'=>$_SESSION['userinfo']['user_id'],
                        'yht_type'=>$type,
                        'yht_username'=>$username,
                        'yht_certifyType'=>$type==2? 1:"",
                        'yht_identityRegion'=>$type==1? 0:"",
                        'yht_certifyNum'=>$certifyNum,
                        'yht_phoneRegion'=>$type==1? 0:"",
                        'yht_phoneNo'=>$phoneNo,
                        'yht_signerId'=>$signerId,
                        'yht_moulageId'=>$moulageId,
                        'yht_created_time'=>date("Y-m-d H:i:s"),
                    ];
                    Yii::$app->db->createCommand()->insert('yii2_wx_yht_info',$inData)->execute();
                    output::ajaxReturn(200,'success',['signerId'=>$signerId,'moulageId'=>$moulageId]);
                }elseif ($res['code']==20209){
                    //认证号码已经存在
                    output::ajaxReturn($res['code'],"认证号码已经存在");
                }else{
                    output::ajaxReturn($res['code'],"提交的资料格式不正确");
                }
            }catch (GuzzleException $e){
                Yii::error($e->getMessage());
//                p($e->getMessage());
                output::ajaxReturn(400,"提交的资料格式不正确");
            }
        }
    }

    /**
     * 获取用户base64印模图片
     * @param $moulageId
     */
    public function actionGetMoulage($moulageId){
//        output::ajaxReturn(200,'success');
        if (Yii::$app->request->isAjax){
            $yhtClient = new YhtClient();
            try{
                $user_id = $_SESSION['userinfo']['user_id'];
                $exist = Yii::$app->db->createCommand("select yht_moulage_base64 from yii2_wx_yht_info where user_id={$user_id}")->queryScalar();
                if (!empty($exist) && $exist){
                    $base64 = $exist;
                }else{
                    $res = $yhtClient->sendReq('get',"user/moulage/$moulageId");
                    if ($res['code']==200){
                        $base64 = $res['data']['moulage']['imgBase'];
                        //保存到数据库
                        Yii::$app->db->createCommand()->update('yii2_wx_yht_info',['yht_moulage_base64'=>$base64],['user_id'=>$user_id])->execute();
                    }else{
                        output::ajaxReturn($res['code'],$res['msg']);
                    }
                }
                output::ajaxReturn(200,'success', $base64);
            }catch (GuzzleException $e){
                Yii::error($e->getMessage());
                output::ajaxReturn(401,'请求远程资源失败');
            }catch (\yii\db\Exception $e){
                Yii::error($e->getMessage());
                output::ajaxReturn(402,'请求远程资源失败');
            }
        }
    }

    /**
     * 动作:印模页点击验证  促发:添加乙方签署人+ 静默合同签署
     * @param $contractId
     * @throws \yii\db\Exception
     */
    public function actionContractSign($contractId){
        if (Yii::$app->request->isAjax){
            $signerId = $_SESSION['userinfo']['yht_signerId'];
            //添加签署人+静默合同签署
            $client = new YhtClient();
            $verifyPhone = YhtClient::$verifyPhone;//签署验证方式
            $signerInfo = [
                "signerId" => $signerId,//签署者 id
                "signPositionType" => 1,//签署的定位方式：0 关键字定位，1 签名占位符定位，2 签署坐标
                "positionContent" => YhtClient::$pos[1],//对应定位方式的内容，如果用签名占位符定位可以传多个签名占位符，并以分号隔开,最多 20 个;如果用签署坐标定位，则该参数包含三个信息：“页面,x 轴坐标,y 轴坐标”（如 20,30,49）
                "signValidateType" => $verifyPhone//签署验证方式：0 不校验，1 短信验证
            ];
            try{
                //添加签署人
                $addRes = $client->sendReq('post',YhtClient::$url['contract']['signer'],["idType"=>0,"idContent"=>$contractId,"signers"=>[$signerInfo] ]);
                if ($addRes['code']==200){
                    output::ajaxReturn(200,'success',['verifyPhone'=>$verifyPhone]);
                }else{
                    output::ajaxReturn($addRes['code'],$addRes['msg']);
                }
            }catch (GuzzleException $e){
                Yii::error($e->getMessage());
                output::ajaxReturn(400,$e->getMessage());
            }
        }
    }

    /**
     *  获取短信验证码
     * @param $contractId
     * @throws \yii\db\Exception
     */
    public function actionVerify($contractId){
        $yhtClient = new YhtClient();
        try{
            $res = $yhtClient->sendReq('get',"contract/msg/verificationCode/0/{$contractId}",null,2);
            if ($res['code']==200){
                output::ajaxReturn(200,'success', $res['data']);
            }else{
                output::ajaxReturn(201,$res['msg']);
            }
        }catch (GuzzleException $e){
            Yii::error($e->getMessage());
            output::ajaxReturn(401,'请求远程资源失败');
        }
    }

    /**
     * 验证短信码 + 甲方签署成功 + 合同存证
     * @param $contractId
     * @param $code
     * @throws \yii\db\Exception
     */
    public function actionVerifyCheck($contractId, $code=null){
        $yhtClient = new YhtClient();
        $db = Yii::$app->db;//开启事务
        $trans = $db->beginTransaction();
        $signerId = $_SESSION['userinfo']['yht_signerId'];
        $userId = $_SESSION['userinfo']['user_id'];
        try{
            if ($code){
                //手机短信码验证
                $res = $yhtClient->sendReq('post',"contract/msg/verificationCode",[
                    "idType"=> 0, //id 类型：0 为合同 ID，1 合同自定义编号
                    "idContent"=> $contractId, //ID 内容
                    "verificationCode"=> $code //验证码，四位数字
                ],2);
                if ($res['code']==200){
                    //乙方进行合同签署
                    $signRes = $yhtClient->sendReq('post',YhtClient::$url['contract']['sign'],["idType"=>0,"idContent"=>$contractId,"signerId"=>$signerId]);
                    if ($signRes['code']==200){

                    }else{
                        output::ajaxReturn($signRes['code'],$signRes['msg']);
                    }
                }else{
                    output::ajaxReturn($res['code'],$res['msg']);
                }
            }
            //最后一步,获取合同创建人甲方signerId
            $ownerSignerId = Yii::$app->db->createCommand("select cont_owner_signerId from yii2_wx_yht_contract where cont_contractId={$contractId}")->queryScalar();
            //合同签署,甲方发起签署
            $signRes = $yhtClient->sendReq('post',YhtClient::$url['contract']['sign'],["idType"=>0,"idContent"=>$contractId,"signerId"=>YhtClient::$hjzSignerId]);
            if ($signRes['code']==200){
                //合同存证
                $czId = " ";
                if (YhtClient::$cz){
                    $czRes = $yhtClient->sendReq('post',YhtClient::$url['contract']['cz'],['idType'=>0,'idContent'=>$contractId]);
                    if ($czRes['code']==200){
                        $czId = $czRes['data']['czId'];
                    }
                }
                //双方完成签署, 合同进行锁定
                //进行锁定,插入乙方记录
                $db->createCommand()->insert('yii2_wx_yht_contract_signer',['contract_id'=>$contractId,'user_id'=>$userId,'signer_id'=>$signerId,'created_at'=>date("Y-m-d H:i:s")])->execute();
                //更新合同状态，更新合同锁定状态
                $db->createCommand()->update('yii2_wx_yht_contract',['cont_status'=>1,'cont_has_bind'=>2,'cont_czid'=>$czId],['cont_contractId'=>$contractId])->execute();
                $trans->commit();
                output::ajaxReturn(200,'success');
            }else{
                output::ajaxReturn($signRes['code'],$signRes['msg']);
            }
        }catch (GuzzleException $e){
            Yii::error($e->getMessage());
            output::ajaxReturn(400,'请求远程资源失败');
        }catch (\yii\db\Exception $e){
            $trans->rollBack();
//            Yii::error($e->getMessage());
            wxlog($e->getMessage());
            output::ajaxReturn(204,"抱歉! 系统出错,请刷新再试");
        }
    }

    /**
     * 验证成功页
     * @param $contractId
     * @return string
     */
    public function actionVerifySuccess($contractId){
        $conInfo = WxYhtContract::findOne(['cont_contractId'=>$contractId]);
        return $this->render('verify-success',['contractId'=>$contractId,'title'=>$conInfo->cont_title]);
    }

    /**
     * @param null $con
     * @param null $content
     * @throws \yii\db\Exception
     */
    private function log($con=null, $content=null){
        Yii::$app->db->createCommand()->insert('yii2_wx_yht_log',[
            'username'=>$_SESSION['userinfo']['username'],
            'controller'=>$con,
            'content'=>$content,
            'created_at'=>date("Y-m-d H:i:s")
        ])->execute();
    }

    public function actionClear(){
        p("清理完成");
        Yii::$app->session->removeAll();
    }
}
