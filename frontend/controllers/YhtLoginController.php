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
     * Todo 二维码下面显示随机数字
     */
    public function actionWeb(){
        //非微信用户登录
//        if (Yii::$app->request->isPost){
//            $username = Yii::$app->request->post('yht_username','');
//            $phoneNum = Yii::$app->request->post('yht_phoneNo','');
//            if ($username && $phoneNum){
//                $yhtInfo = WxYhtInfo::findOne(['yht_username'=>$username,'yht_phoneNo'=>$phoneNum]);
//                if (empty($yhtInfo)){
//                    return $this->render('/yht/fail',['msg'=>"1.用户名或密码错误  2.用户未注册"]);
//                }else{
//                    $userInfo = WxUser::findOne(['user_id'=>$yhtInfo->user_id]);
//                    if (empty($userInfo)){
//                        return $this->render('/yht/fail',['msg'=>"用户不存在"]);
//                    }
//                    $userInfo = $userInfo->toArray();
//                    Yii::$app->session->set('userinfo',$userInfo);
//                    $_SESSION['userinfo']['yht_signerId'] = $yhtInfo->yht_signerId;
//                    $_SESSION['userinfo']['yht_username'] = $yhtInfo->yht_username;
//                    $_SESSION['userinfo']['yht_authority'] = $yhtInfo->yht_authority;
//                    $_SESSION['userinfo']['client'] = 'web';
//                    $accessUrl = array_key_exists('accessUrl',$_SESSION)? $_SESSION['accessUrl']:Url::toRoute(['yht/index'],true);
//                    return $this->redirect($accessUrl);
//                }
//            }
//        }else{
//            return $this->render('/yht/web-login');
//        }
        if (Yii::$app->wechat->isWechat){
            //平台验证和授权验证
            if (!Yii::$app->wechat->isAuthorized()){
                return Yii::$app->wechat->authorizeRequired()->send();
            }
            //用户是否存在
            if(!Yii::$app->session->has("userinfo") && Yii::$app->wechat->isAuthorized()){
                (new WxUser)->createUser();
            }
            // 确认授权
            if (Yii::$app->request->isAjax){
                $echostr = Yii::$app->request->param('echostr',0);
                $confirm = Yii::$app->request->param('confirm',0);
                if ($echostr>0 && $confirm==1){
                    $openId = $_SESSION['userinfo']['open_id'];
                    Yii::$app->cache->set($echostr,$openId);
                    output::ajaxReturn(200);
                }else{
                    output::ajaxReturn(204,'登录失败');
                }
            }else{
                return $this->render('/yht/web-login',['qrAuth'=>1,'echostr'=>0]);
            }
        }else{
            //设置redis key
            Yii::$app->cache->set('12345','');
            return $this->render('/yht/web-login',['qrAuth'=>0,'echostr'=>12345]);
        }
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
     * 轮询扫码结果
     */
    public function actionAskauth(){
        if (Yii::$app->request->isAjax){
            $echostr = Yii::$app->request->get('echostr',0);
            if (!empty($echostr)){
                $openId = Yii::$app->cache->get($echostr);
                if (!empty($openId)){
                    //跳转地址
                    $returnUrl = Url::toRoute(['yht/index'],true);
                    if(Yii::$app->session->has("userinfo") && !empty($_SESSION['userinfo'])){
                        Yii::$app->cache->delete($echostr);
                        output::ajaxReturn(200,'success',$returnUrl);
                    }
                    $userInfo = WxUser::findOne(['open_id'=>$openId]);
                    if (!empty($userInfo)){
                        $info = $userInfo->toArray();
                        $yhtInfo = WxYhtInfo::findOne(['user_id'=>$info['user_id']]);
                        if (!empty($yhtInfo)){
                            $info['yht_signerId'] = $yhtInfo->yht_signerId;
                            $info['yht_username'] = $yhtInfo->yht_username;
                            $info['yht_authority'] = $yhtInfo->yht_authority;
                            Yii::$app->session->set('userinfo',$info);
                            Yii::$app->cache->delete($echostr);
                            output::ajaxReturn(200,'success',$returnUrl);
                        }else{
                            output::ajaxReturn(203,'授权失败');
                        }
                    }else{
                        output::ajaxReturn(203,'授权失败');
                    }
                }
            }
        }
    }
}
