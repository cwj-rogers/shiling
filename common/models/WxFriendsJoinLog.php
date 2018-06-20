<?php

namespace common\models;

use Yii;
use yii\db\Expression;
use yii\db\Exception;

/**
 * This is the model class for table "{{%wx_friends_join_log}}".
 *
 * @property integer $fj_id
 * @property integer $ago_id
 * @property integer $user_id
 * @property string $fj_user_name
 * @property string $fj_image
 * @property string $fj_cut_price
 * @property string $fj_join_date
 * @property string $created_time
 * @property string $fj_lat_lon
 */
class WxFriendsJoinLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_friends_join_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ago_id', 'user_id', 'fj_user_name', 'fj_image', 'fj_cut_price'], 'required'],
            [['ago_id', 'user_id'], 'integer'],
            [['fj_cut_price'], 'number'],
            [['created_time'], 'safe'],
            [['fj_user_name'], 'string', 'max' => 64],
            [['fj_image','fj_lat_lon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fj_id' => 'Fj ID',
            'ago_id' => '活动商品id',
            'user_id' => '用户id',
            'fj_user_name' => '用户名称',
            'fj_image' => '用户头像',
            'fj_cut_price' => '砍价金额',
            'fj_join_date' => '参与日期',
            'fj_lat_lon' => '地理位置',
            'created_time' => '参与时间',
        ];
    }

    /**
     * @param $identity
     * @param $order
     * @param $ago_id
     * @param $user_id
     * @param $lat
     * @param $lon
     * @return bool
     * @throws \yii\db\Exception
     */
    public function kanjiaRule($identity, $order, $ago_id, $user_id, $lat, $lon){
        //找出商品市场价
        $good = WxGoods::findOne(['wg_id'=>$order['wg_id']]);
        //计算剩余砍价金额和剩余次数
        $remainPrice = $good->wg_market_price - $order['ago_cut_total'] - 9.9;
        $remainNum = $order['ago_need_cut'] - $order['ago_cut_number'];

        if ($identity=="user"){
            $isShare = ($order['ago_share_time']>0 && $order['ago_share_kanjia']==0)? 1:0;
        }
        if (1 == $remainNum){
            $price = $remainPrice; //最后一次砍价,价格为剩余金额
            $status = 2;//砍价成功
        }else{
            /**
             * 砍价计算规则
             * 剩余金额/剩余次数=砍价均价, 设置浮动上限
             */
            $averagePrice = floor($remainPrice/$remainNum);// 均价取整
            $price = rand(0,$averagePrice*2-1) + rand(0,100)/100;// 随机波动保留小数点后两位
            $price = $price<$averagePrice*2? $price : $averagePrice;// 随机价格校验
            wxlog("计算价格id{$order['ago_id']}:$remainPrice -- $remainNum -- averagePrice:{$averagePrice} -- price:{$price}");
        }

        //开启事务
        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try{
            if ($price){
//                wxlog("数据开始入库");
                //砍价表添加记录
                $this->ago_id = $ago_id;
                $this->user_id = $user_id;
                $this->fj_user_name = $_SESSION['userinfo']['username'];
                $this->fj_image = $_SESSION['userinfo']['image'];
                $this->fj_cut_price = $price;
                $this->fj_join_date = date("Y-m-d");
                $this->created_time = date("Y-m-d H:i:s");
                $this->fj_lat_lon = $lat.",".$lon;
                $res = $this->save();
                if(!$res) wxlog(json_encode($this->getErrors()));

                //修改商品订单表
                $updateArr = [
                    'ago_cut_total'=> $order['ago_cut_total']+$price,
                    'ago_cut_number'=> $order['ago_cut_number']+1,
                    'ago_share_kanjia'=> isset($isShare)? $isShare:0,
                    'ago_status'=> isset($status)? $status:1,
                ];
                $db->createCommand()->update('yii2_wx_activities_order', $updateArr, "ago_id={$ago_id}")->execute();

                //修改商品表,记录砍价成功
                if (1 == $remainNum){
                    $db->createCommand()->update('yii2_wx_goods', ['wg_finish_deal'=>new Expression("`wg_finish_deal`+1")], "wg_id={$order['wg_id']}")->execute();
                }
            }
            $transaction->commit();
            return $price;
        } catch (Exception $e){
            YII::warning(json_encode($e->getMessage()));
            $transaction->rollback();
            return false;
        }

    }
}
