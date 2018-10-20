<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_friends_share_log}}".
 *
 * @property integer $fs_id
 * @property integer $ago_id
 * @property integer $user_id
 * @property integer $visitor_id
 * @property integer $share_cut
 * @property string $share_date
 * @property string $created_time
 */
class WxFriendsShare extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_friends_share_log}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ago_id', 'user_id', 'visitor_id'], 'required'],
            [['ago_id', 'user_id', 'visitor_id', 'share_cut'], 'integer'],
            [['created_time','share_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'fs_id' => 'Fs ID',
            'ago_id' => 'Ago ID',
            'user_id' => 'User ID',
            'visitor_id' => 'Visitor ID',
            'share_cut' => '分享次数',
            'share_date' => '分享时间',
            'created_time' => 'Created Time',
        ];
    }

    public function insertLog($agoId, $userId, $visitorId){
        if ($agoId && $userId && $visitorId){
            $this->ago_id = $agoId;
            $this->user_id = $userId;
            $this->visitor_id = $visitorId;
            $this->share_date = date("Y-m-d");
            $this->created_time = date("Y-m-d H:i:s");
            $res = $this->save();
            return 1;
        }
    }
}
