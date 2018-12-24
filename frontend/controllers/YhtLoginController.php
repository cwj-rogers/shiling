<?php

namespace frontend\controllers;
use yii\helpers\Url;
use Yii;
use common\models\WxYhtInfo;
use common\widgets\YhtClient;
use common\models\WxUser;
use common\helpers\FuncHelper as output;

class YhtLoginController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'yhtmain';

    /**
     * PC web端登录
     * @return string|\yii\web\Response
     * Todo 显示随机数字
     */
    public function actionWeb(){
        if (Yii::$app->wechat->isWechat){
            //平台验证和授权验证
            if (!Yii::$app->wechat->isAuthorized()){
                return Yii::$app->wechat->authorizeRequired()->send();
            }
            //用户是否存在
            if(!Yii::$app->session->has("userinfo") && Yii::$app->wechat->isAuthorized()){
                (new WxUser)->createUser();
            }

            if (Yii::$app->request->isAjax){
                //WX端 异步提交验证码
                $vcode = Yii::$app->request->param('vcode',0);
                $confirm = Yii::$app->request->param('confirm',0);
                if ($vcode>0 && $confirm==1){
                    $openId = $_SESSION['userinfo']['open_id'];
                    // 判断验证码是否存在
                    $exist = Yii::$app->cache->exists($vcode);
                    if (!$exist){
                        output::ajaxReturn(205,'验证码错误');
                    }
                    Yii::$app->cache->set($vcode,$openId);
                    output::ajaxReturn(200);
                }else{
                    output::ajaxReturn(204,'缺少验证码');
                }
            }else{
                //WX 端授权页面
                return $this->render('/yht/web-login',['qrAuth'=>1,'vcode'=>'']);
            }
        }else{
            //PC 端页面
            $vcode = rand(1000,9999);
            Yii::$app->cache->set($vcode,'');
            return $this->render('/yht/web-login',['qrAuth'=>0,'vcode'=>$vcode]);
        }
    }

    public function actionTest(){
        return $this->render('/yht/web-login',['qrAuth'=>1,'vcode'=>'']);
    }

    /**
     * 注册页面
     * @return string|void
     */
    public function actionRegister(){
        if (!Yii::$app->wechat->isWechat){
            //web 端进入弹出二维码,扫描进入微信注册渠道
            return $this->render('/yht/web-register',['showQrcode'=>1]);
        }else{
            if (Yii::$app->request->isPost){

            }else{
                //平台验证和授权验证
                if (!Yii::$app->wechat->isAuthorized()){
                    return Yii::$app->wechat->authorizeRequired()->send();
                }
                //用户是否存在
                if(!Yii::$app->session->has("userinfo") && Yii::$app->wechat->isAuthorized()){
                    (new WxUser)->createUser();
                }
                return $this->render('/yht/web-register',['showQrcode'=>0]);
            }
        }
    }

    /*
     *  文件下载页面 微信端显示短连接
     */
    public function actionDownUrl($contractId=null,$url=null){
        if (Yii::$app->request->isAjax){
            $shortUrl = Yii::$app->wechat->url->shorten($url);
            output::ajaxReturn(200,'success',$shortUrl);
        }else{
            return $this->render('/yht/down-url',['contractId'=>$contractId]);
        }
    }

    /**
     * PC 端轮询获取结果
     */
    public function actionAskauth(){
        if (Yii::$app->request->isAjax){
            $vcode = Yii::$app->request->get('vcode',0);
            $openId = Yii::$app->cache->get($vcode);
            if ($openId){
                //跳转地址
                $returnUrl = Url::toRoute(['yht/index'],true);
                if(Yii::$app->session->has("userinfo") && !empty($_SESSION['userinfo'])){
                    Yii::$app->cache->delete($vcode);
                    output::ajaxReturn(200,'success',$returnUrl);
                }else{
                    $userInfo = WxUser::findOne(['open_id'=>$openId]);
                    if (!empty($userInfo)){
                        $info = $userInfo->toArray();
                        $yhtInfo = WxYhtInfo::findOne(['user_id'=>$info['user_id']]);
                        if (!empty($yhtInfo)){
                            $info['yht_signerId'] = $yhtInfo->yht_signerId;
                            $info['yht_username'] = $yhtInfo->yht_username;
                            $info['yht_authority'] = $yhtInfo->yht_authority;
                            Yii::$app->session->set('userinfo',$info);
                            Yii::$app->cache->delete($vcode);
                            output::ajaxReturn(200,'success',$returnUrl);
                        }else{
                            output::ajaxReturn(203,'授权失败,请刷新页面');
                        }
                    }else{
                        output::ajaxReturn(203,'授权失败,请刷新页面');
                    }
                }
            }
        }
    }
}
