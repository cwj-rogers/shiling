<?php

namespace frontend\controllers;
use common\models\WxFriendsShare;
use Yii;
use yii\web\Controller;
use common\models\WxGoods;
use common\models\WxUser;
use common\models\WxActivitiesOrder;
use common\models\WxFriendsJoinLog;
use yii\db\Expression;
use yii\helpers\Url;

class IndexController extends Controller
{
    /**
     * @var string
     */
//    public $layout = 'main';
    public $layout = 'kjmain';

    /**
     * 初始化 微信授权 保存微信用户信息
     */
    public function init()
    {
        if (!Yii::$app->wechat->isWechat){
            return Yii::$app->wechat->oauth->redirect()->send();
        }
        //开启session
        if (!Yii::$app->session->isActive){
            Yii::$app->session->open();
        }
        //平台验证和授权验证
        if (Yii::$app->wechat->isWechat && !Yii::$app->wechat->isAuthorized()){
            return Yii::$app->wechat->authorizeRequired()->send();
        }
        if(!Yii::$app->session->has("userinfo") && Yii::$app->wechat->isAuthorized()){
            (new WxUser)->createUser();
        }
        parent::init(); // TODO: Change the autogenerated stub
    }

    public function actionIndex(){
        //验证服务器
        if (Yii::$app->request->get('echostr',false)){
            //执行服务端业务
            $response = Yii::$app->wechat->server->serve();
            // 将响应输出
            $response->send();
        }
        $res = [];//储存数据集
        //@Todo 1.参与过得 2.砍价成功的  是否显示
        $res['goodslist'] = WxGoods::goodsList();
        //砍价活动页
        return $this->render('kanjia', ['res'=>$res]);
    }

    /**
     * @return 砍价详情
     */
    public function actionDetail(){
        /**
         * 1. 判断是自己还是好友访问
         * 2. 自己: 第一次进入? 创建新商品订单(砍一刀):读取数据库  已分享? 先砍一刀:不操作  砍价成功? 微信通知:到期提醒
         * 3. 好友: 符合砍价条件? 进入砍价: 不符合; 第一次砍价? 创建新用户: 直接砍价;
         */
        $userId = Yii::$app->request->get('user_id',0);
        $wgId = Yii::$app->request->get('wg_id',0);
        if(!$userId || !$wgId || !isset($_SESSION['userinfo'])){
            return $this->redirect(['index']);
        }

        if($_SESSION['userinfo']['user_id']==$userId){
            $isVisit = 0;
            //是否已经参加过 1.未过期的 2.已经砍价成功的
            $isexist = WxActivitiesOrder::findOne(['user_id'=>$userId,'wg_id'=>$wgId]);
            //进入创建订单
            if (empty($isexist) || in_array($isexist['ago_status'],[2,3,4])){
                (new WxActivitiesOrder)->createActOrder($wgId, $userId);
            }
        }else{
            $agoId = Yii::$app->request->get('ago_id',0);
            //朋友访问
            $isVisit = 1;
            //今天是否参与分享
            $hasVisitShare = WxFriendsShare::findOne(['ago_id'=>$agoId,'user_id'=>$userId,'visitor_id'=>$_SESSION['userinfo']['user_id'],'share_date'=>date("Y-m-d")]);
        }
        $hasVisitShare = isset($hasVisitShare)? $hasVisitShare:0;
        $res = WxActivitiesOrder::getActOrder($wgId, $userId);//商品订单
        $res['isVisit'] = $isVisit;
        $res['hasVisitShare'] = $hasVisitShare;
        return $this->render('kj-detail', ['res'=>$res]);
    }

    /**
     * 异步访问砍价功能
     * @param $agoId
     * @param $userId
     * @param int $lat
     * @param int $lon
     * @throws \yii\db\Exception
     */
    public function actionKj($agoId,$userId,$lat=0,$lon=0)
    {
        if (Yii::$app->request->isAjax && $agoId && $userId){
            //找出商品订单
            $order = WxActivitiesOrder::findOne(['ago_id'=>$agoId,'user_id'=>$userId, 'ago_status'=>1]);
            if (empty($order)) \common\helpers\FuncHelper::ajaxReturn(201,'系统无反应');
            $order = $order->toArray();
            $SUID = $_SESSION['userinfo']['user_id'];

            if ($order['ago_cut_number']<$order['ago_need_cut'] && time()<strtotime($order['ago_exprice_time'])){
                if($SUID==$userId){
                    //本人: 分享后才能砍价, 前后台都加判断避免刷单
                    if ($order['ago_share_time']>0 && $order['ago_share_kanjia']==0){
                        $res = (new WxFriendsJoinLog)->kanjiaRule('user',$order,$agoId,$userId,$lat,$lon);
                        if($res) \common\helpers\FuncHelper::ajaxReturn(200,'success', $res);
                    }else{
                        \common\helpers\FuncHelper::ajaxReturn(202,'分享好友后获得砍价机会');
                    }
                }else{
                    //朋友: 1.同城 2.每天只能一次 3.已经分享给朋友
                    if($_SESSION['userinfo']['city']==$order['ago_city']){
                        $shareExsit = WxFriendsShare::findOne(['ago_id'=>$agoId,'visitor_id'=>$SUID,'share_date'=>date("Y-m-d")]); //参与条件
                        if (!empty($shareExsit)){
                            $exsit = WxFriendsJoinLog::findOne(['ago_id'=>$agoId,'user_id'=>$SUID, 'fj_join_date'=>date("Y-m-d")]); //参与条件
                            if (empty($exsit)){
                                $res = (new WxFriendsJoinLog)->kanjiaRule('friends',$order,$agoId,$SUID,$lat,$lon);
                                if($res) \common\helpers\FuncHelper::ajaxReturn(200,'success', $res);
                            }else{
                                \common\helpers\FuncHelper::ajaxReturn(202,'今天您的帮助次数已用完');
                            }
                        }else{
                            \common\helpers\FuncHelper::ajaxReturn(202,'分享好友后获得砍价机会');
                        }
                    }else{
                        \common\helpers\FuncHelper::ajaxReturn(202,'双方好友必须在同一城市');// 返回失败
                    }
                }
            }else{
                \common\helpers\FuncHelper::ajaxReturn(202,'该商品活动已过期');
            }
        }
        // 返回失败
        \common\helpers\FuncHelper::ajaxReturn(201,'系统无反应');
    }

    /**
     * @param $agoId
     * @throws \yii\db\Exception
     */
    public function actionShare($agoId, $userId)
    {
        //增加一个分享记录表
        (new WxFriendsShare())->insertLog($agoId, $userId, $_SESSION['userinfo']['user_id']);
        //订单分享记录+1
        Yii::$app->db->createCommand()->update("yii2_wx_activities_order",["ago_share_time"=>new Expression("`ago_share_time`+1")],['ago_id'=>$agoId])->execute();
        \common\helpers\FuncHelper::ajaxReturn(200,'success');
    }

    /**
     * 异步记录用户地理位置
     */
    public function actionUserLocal()
    {
        $result = Yii::$app->wechat->app->material->uploadVoice("./static/kanjia.mp3");
    }

    /**
     * @return 用户中心
     */
    public function actionUser($ago_status){
        $res = WxActivitiesOrder::getOrderList($_SESSION['userinfo']['user_id'],$ago_status);
        return $this->render('user',['res'=>$res]);
    }

    public function actionClear(){
        Yii::$app->session->removeAll();
        p(Yii::$app->session);
    }
}
