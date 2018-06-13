<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_activities_order}}".
 *
 * @property string $ago_id
 * @property string $ago_order_sn
 * @property integer $user_id
 * @property integer $wg_id
 * @property string $ago_cut_total
 * @property integer $ago_cut_number
 * @property integer $ago_need_cut
 * @property integer $ago_share_time
 * @property integer $ago_status
 * @property integer $ago_payment_method
 * @property string $ago_province
 * @property string $ago_city
 * @property integer $ago_take_method
 * @property integer $ago_return_call
 * @property string $ago_exprice_time
 * @property string $created_time
 */
class WxActivitiesOrder extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_activities_order}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'wg_id'], 'required'],
            [['user_id', 'wg_id', 'ago_cut_number', 'ago_need_cut', 'ago_share_time', 'ago_status', 'ago_payment_method', 'ago_take_method', 'ago_return_call'], 'integer'],
            [['ago_cut_total'], 'number'],
            [['ago_exprice_time', 'created_time'], 'safe'],
            [['ago_order_sn'], 'string', 'max' => 24],
            [['ago_province', 'ago_city'], 'string', 'max' => 10],
            [['ago_order_sn'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ago_id' => 'id',
            'ago_order_sn' => '商品的名称',
            'user_id' => '用户id',
            'wg_id' => '商品id',
            'ago_cut_total' => '累积砍价',
            'ago_cut_number' => '已砍价次数',
            'ago_need_cut' => '需要砍价次数',
            'ago_share_time' => '分享次数',
            'ago_status' => '状态  1活动中 2.活动结束已支付 3.结束没支付',
            'ago_payment_method' => '支付方式 1.微信',
            'ago_province' => '省份',
            'ago_city' => '城市',
            'ago_take_method' => '取货方式 1.到店自取',
            'ago_return_call' => '电话是否回访 ',
            'ago_exprice_time' => '到期时间',
            'created_time' => '添加时间',
        ];
    }

    /**
     * 创建新的商品订单
     * @param $wgid
     * @param $userId
     */
    public function createActOrder($wgid,$userId){
        $wg = WxGoods::findOne($wgid);
        $userinfo = $_SESSION['userinfo'];
        if (!empty($wg)){
            $this->ago_order_sn = '100062'.mt_rand(10000,99999).round(microtime(true)*1000);
            $this->user_id = $userId;
            $this->wg_id = $wgid;
            $this->ago_need_cut = $wg->wg_need_cut;
            $this->ago_province = $userinfo['province'];
            $this->ago_city = $userinfo['city'];
            $this->ago_exprice_time = date('Y-m-d H:i:s', time()+$wg->wg_promote_time);
            $this->created_time = date('Y-m-d H:i:s');
            $res = $this->save();
            if(!$res) p($this->getErrors(),1);
        }
    }

    public static function getActOrder($wgId,$userId){
        $res = static ::find()->select("*")->from(['ago'=>'yii2_wx_activities_order'])->leftJoin("yii2_wx_goods wg","ago.wg_id=wg.wg_id")->where(['ago.wg_id'=>$wgId,'user_id'=>$userId])->asArray()->all();
        $res = $res[0];
        $nameArr = explode(" ",$res['wg_name']);
        $res['wg_name'] = $nameArr[0];
        $res['centi'] =  intval($res['ago_cut_total']/($res['wg_market_price']-9.9)*100).'%';
        $res['joiners'] = WxFriendsJoinLog::find()->where(['ago_id'=>$res['ago_id']])->orderBy("fj_cut_price desc")->asArray()->all();
        //p($res,1);
        return $res;
    }
}
