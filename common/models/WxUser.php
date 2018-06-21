<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_user}}".
 *
 * @property string $user_id
 * @property string $open_id
 * @property string $username
 * @property string $image
 * @property integer $status
 * @property string $mobile
 * @property integer $sex
 * @property string $province
 * @property string $city
 * @property string $reg_ip
 * @property string $reg_time
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
            [['open_id', 'username', 'sex', 'province', 'city'], 'required'],
            [['status', 'sex'], 'integer'],
            [['reg_time', 'update_time'], 'safe'],
            [['open_id', 'reg_ip'], 'string', 'max' => 32],
            [['username'], 'string', 'max' => 31],
            [['image', 'province', 'city'], 'string', 'max' => 255],
            [['mobile'], 'string', 'max' => 15],
            [['mobile'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => '用户ID',
            'open_id' => '微信用户标记',
            'username' => '用户名',
            'image' => '头像路径',
            'status' => '用户状态 1正常 0禁用',
            'mobile' => '用户手机',
            'sex' => '性别',
            'province' => '省',
            'city' => '城市',
            'reg_ip' => '注册IP',
            'reg_time' => '注册时间',
            'update_time' => '更新时间',
        ];
    }

    /**
     * 创建新用户
     */
    public function createUser(){
        $userinfo = json_decode(Yii::$app->session->get('_wechatUser'),true);
        $hasuser = WxUser::findOne(['open_id'=>$userinfo['id']]);
        if (empty($hasuser)){
            $this->open_id = $userinfo['id'];
            $this->username = $userinfo['name'];
            $this->image = $userinfo['avatar'];
            $this->sex = $userinfo['original']['sex'];
            $this->province = $userinfo['original']['province'];
            $this->city = $userinfo['original']['city'];
            $this->reg_time = date("Y-m-d H:i:s");
            $this->reg_ip = Yii::$app->request->getUserIP();
            $res = $this->save();
            if(!$res) wxlog(json_encode($this->getErrors()));

            $info = WxUser::findOne(['open_id'=>$userinfo['id']]);
            $info = $info->toArray();
            Yii::$app->session->set('userinfo',$info);
        }else{
            $info = $hasuser->toArray();
            Yii::$app->session->set('userinfo',$info);
        }
    }
}
