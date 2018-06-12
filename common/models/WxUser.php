<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_user}}".
 *
 * @property string $wx_uid
 * @property string $open_id
 * @property string $username
 * @property string $image
 * @property integer $status
 * @property string $mobile
 * @property integer $sex
 * @property string $province
 * @property string $city
 * @property string $reg_time
 * @property string $reg_ip
 * @property string $update_time
 */
class WxUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'sex', 'province', 'city'], 'required'],
            [['status', 'sex'], 'integer'],
            [['open_id'], 'string', 'max' => 32],
            [['username'], 'string', 'max' => 16],
            [['image', 'province', 'city'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 15],
            [['username'], 'unique'],
            [['mobile'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wx_uid' => '用户ID',
            'open_id' => 'Open ID',
            'username' => '用户名',
            'image' => '头像路径',
            'status' => '用户状态 1正常 0禁用',
            'mobile' => '用户手机',
            'sex' => '性别',
            'province' => '省',
            'city' => '城市',
            'reg_time' => '注册时间',
            'reg_ip' => '注册IP',
            'update_time' => '更新时间',
        ];
    }

    /**
     * 创建新用户
     */
    public function createUser(){
        $userinfo = json_decode(Yii::$app->session->get('_wechatUser'),true);
        $hasuser = WxUser::findOne(['open_id'=>$userinfo['id']]);//p($hasuser,1);
        if (empty($hasuser)){
            $this->open_id = $userinfo['id'];
            $this->username = $userinfo['name'];
            $this->image = $userinfo['avatar'];
            $this->sex = $userinfo['original']['sex'];
            $this->province = $userinfo['original']['province'];
            $this->city = $userinfo['original']['city'];
            $this->reg_time = date("Y-m-d H:i:s");
            $this->reg_ip = Yii::$app->request->getUserIP();
            $res=$this->save();
        }
        $info = WxUser::findOne(['open_id'=>$userinfo['id']]);
        Yii::$app->session->set('userinfo',);p(Yii::$app->session->get('userinfo'),1);
    }
}
