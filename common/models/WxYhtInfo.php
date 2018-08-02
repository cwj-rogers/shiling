<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_yht_info}}".
 *
 * @property integer $yht_id
 * @property integer $user_id
 * @property string $yht_signerId
 * @property integer $yht_authority
 * @property string $yht_node_tmp
 * @property integer $yht_type
 * @property string $yht_username
 * @property string $yht_certifyType
 * @property string $yht_identityRegion
 * @property string $yht_certifyNum
 * @property string $yht_phoneRegion
 * @property string $yht_phoneNo
 * @property string $yht_moulageId
 * @property string $yht_moulage_base64
 * @property string $yht_created_time
 */
class WxYhtInfo extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_yht_info}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'yht_moulage_base64'], 'required'],
            [['user_id', 'yht_authority', 'yht_type'], 'integer'],
            [['yht_moulage_base64'], 'string'],
            [['yht_created_time'], 'safe'],
            [['yht_signerId', 'yht_moulageId'], 'string', 'max' => 16],
            [['yht_node_tmp'], 'string', 'max' => 255],
            [['yht_username'], 'string', 'max' => 128],
            [['yht_certifyType', 'yht_certifyNum'], 'string', 'max' => 64],
            [['yht_identityRegion', 'yht_phoneRegion'], 'string', 'max' => 8],
            [['yht_phoneNo'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'yht_id' => 'Yht ID',
            'user_id' => '微信用户id',
            'yht_signerId' => '云合同平台用户 id',
            'yht_authority' => '云合同用户权限 1. 应用平台(超级管理员) 2.普通管理员 3.普通用户',
            'yht_node_tmp' => '普通管理员可操作的合同模板集合',
            'yht_type' => '用户类型 1.个人 2.公司',
            'yht_username' => '个人/公司 名称',
            'yht_certifyType' => '（企业） 相关证件类型包含：1.社会信用代码，2.营
业执照注册号，3.组织机构代码',
            'yht_identityRegion' => '身份地区：0 大陆，1 香港，2 台湾，3 澳门',
            'yht_certifyNum' => '身份证号码，认证号码',
            'yht_phoneRegion' => '手机号地区：0 大陆，1 香港、澳门，2 台湾',
            'yht_phoneNo' => '手机号：1.大陆,首位为 1，长度 11 位纯数字；2.
香港、澳门,长度为 8 的纯数字；3.台湾,长度为 10 的纯数字',
            'yht_moulageId' => '云合同平台印模ID',
            'yht_moulage_base64' => '印模图片 Base64 数据',
            'yht_created_time' => '创建时间',
        ];
    }
}
