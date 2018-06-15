<?php

namespace common\models;

use Yii;

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
     * @param $order
     * @param $ago_id
     * @param $user_id
     * @param $lat
     * @param $lon
     * @return bool
     * @throws \yii\db\Exception
     */
    public function kanjiaRule($order, $ago_id, $user_id, $lat, $lon){
        //找出商品市场价
        $good = WxGoods::findOne(['wg_id'=>$order['wg_id']]);
        //计算剩余次数和剩余砍价金额
        $remainPrice = $good->wg_market_price - $order['ago_cut_total'];
        $remainNum = $good->wg_need_cut - $order['ago_cut_number'];
        if (1 == $remainNum){
            $price = $remainPrice;
        }else{
            /**
             * 砍价计算规则
             * 剩余金额/剩余次数=砍价均价, 设置浮动上限
             */
            $averagePrice = floor($remainPrice/$remainNum);//每次砍的均价取整
            $price = rand(0,$averagePrice*2-1) + rand(0,100)/100;
            $price = $price<$averagePrice*2? $price : round($remainPrice/$remainNum, 2);
        }

        //开启事务
//        $transaction = Yii::$app->db->beginTransaction();
        try{
            if ($price){
                //添加记录
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
                p($res);
                //修改商品订单表
                return $res;
            }
//            $transaction->commit();
        } catch (Exception $e){
            $e->getMessage();
//            $transaction->rollback();
            return false;
        }

    }
}
