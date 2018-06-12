<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_goods}}".
 *
 * @property string $wg_id
 * @property string $wg_name
 * @property string $wg_description
 * @property string $wg_content
 * @property string $wg_goods_album
 * @property string $wg_market_price
 * @property integer $wg_number
 * @property string $wg_view
 * @property integer $wg_finish_deal
 * @property integer $wg_type
 * @property integer $wg_status
 * @property string $wg_promote_time
 * @property integer $wg_sort
 * @property string $created_time
 * @property string $updated_time
 */
class WxGoods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_goods}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wg_content', 'wg_finish_deal'], 'required'],
            [['wg_content'], 'string'],
            [['wg_market_price'], 'number'],
            [['wg_number', 'wg_view', 'wg_finish_deal', 'wg_type', 'wg_status', 'wg_promote_time', 'wg_sort'], 'integer'],
            [['created_time', 'updated_time'], 'safe'],
            [['wg_name'], 'string', 'max' => 120],
            [['wg_description', 'wg_goods_album'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wg_id' => '商品id',
            'wg_name' => '商品的名称',
            'wg_description' => '商品描述',
            'wg_content' => '商品图文',
            'wg_goods_album' => '商品相册图组，逗号相隔，第一张为封面',
            'wg_market_price' => '市场售价',
            'wg_number' => '商品总库存数量，由各sku相加',
            'wg_view' => '查看数量',
            'wg_finish_deal' => '完成数量',
            'wg_type' => '商品促销 1.砍价 2.拼团 3.竞猜',
            'wg_status' => '状态 0下架 1上架',
            'wg_promote_time' => '有效时长(时间戳)默认',
            'wg_sort' => '顺序排序值',
            'created_time' => '添加时间',
            'updated_time' => '修改时间',
        ];
    }
}
