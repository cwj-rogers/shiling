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
 * @property string $ago_real_price
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
            [['user_id', 'wg_id', 'ago_cut_number', 'ago_need_cut', 'ago_take_method'], 'required'],
            [['user_id', 'wg_id', 'ago_cut_number', 'ago_need_cut', 'ago_share_time', 'ago_status', 'ago_payment_method', 'ago_take_method', 'ago_return_call'], 'integer'],
            [['ago_real_price'], 'number'],
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
            'ago_real_price' => '当前价格(原价-累积砍价)',
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
}
