<?php

namespace frontend\controllers;
use yii\helpers\Url;
use Yii;
use common\models\WxYhtInfo;
use common\widgets\YhtClient;
use common\models\WxUser;

class YhtLoginController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'yhtmain';

    /**
     * PC web端登录
     * @return string|\yii\web\Response
     */
    public function actionWeb(){
        //非微信用户登录
        if (Yii::$app->request->isPost){
            $username = Yii::$app->request->post('yht_username','');
            $phoneNum = Yii::$app->request->post('yht_phoneNo','');
            if ($username && $phoneNum){
                $yhtInfo = WxYhtInfo::findOne(['yht_username'=>$username,'yht_phoneNo'=>$phoneNum]);
                if (empty($yhtInfo)){
                    return $this->render('/yht/fail',['msg'=>"1.用户名或密码错误  2.用户未注册"]);
                }else{
                    $userInfo = WxUser::findOne(['user_id'=>$yhtInfo->user_id]);
                    if (empty($userInfo)){
                        return $this->render('/yht/fail',['msg'=>"用户不存在"]);
                    }
                    $userInfo = $userInfo->toArray();
                    Yii::$app->session->set('userinfo',$userInfo);
                    $_SESSION['userinfo']['yht_signerId'] = $yhtInfo->yht_signerId;
                    $_SESSION['userinfo']['yht_username'] = $yhtInfo->yht_username;
                    $_SESSION['userinfo']['yht_authority'] = $yhtInfo->yht_authority;
                    $_SESSION['userinfo']['client'] = 'web';
                    $accessUrl = array_key_exists('accessUrl',$_SESSION)? $_SESSION['accessUrl']:Url::toRoute(['yht/index'],true);
                    return $this->redirect($accessUrl);
                }
            }
        }else{
            return $this->render('/yht/web-login');
        }
    }

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
}
