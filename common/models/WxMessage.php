<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_message}}".
 *
 * @property integer $msg_id
 * @property integer $user_id
 * @property string $msg_user_name
 * @property string $msg_title
 * @property string $msg_content
 * @property string $msg_push_time
 */
class WxMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'msg_user_name', 'msg_title', 'msg_content'], 'required'],
            [['user_id'], 'integer'],
            [['msg_push_time'], 'safe'],
            [['msg_user_name'], 'string', 'max' => 64],
            [['msg_title', 'msg_content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'msg_id' => 'Msg ID',
            'user_id' => '活动商品id',
            'msg_user_name' => '用户名称',
            'msg_title' => '用户头像',
            'msg_content' => '砍价金额',
            'msg_push_time' => '参与时间',
        ];
    }
}
