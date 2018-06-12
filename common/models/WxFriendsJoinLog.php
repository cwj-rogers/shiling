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
 * @property string $created_time
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
            [['fj_image'], 'string', 'max' => 255],
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
            'created_time' => '参与时间',
        ];
    }
}
