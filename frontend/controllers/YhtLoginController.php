<?php

namespace frontend\controllers;
use yii\helpers\Url;
use Yii;
use common\models\WxYhtInfo;
use common\widgets\YhtClient;
use common\models\WxUser;
use yii\db\Query;

class YhtLoginController extends \yii\web\Controller
{
    public $enableCsrfValidation = false;
    public $layout = 'yhtmain';

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
}
