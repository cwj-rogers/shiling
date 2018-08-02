<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_yht_contract}}".
 *
 * @property integer $cont_id
 * @property string $cont_contractId
 * @property integer $cont_owner_signerId
 * @property string $cont_templateId
 * @property integer $cont_has_bind
 * @property integer $cont_status
 * @property string $cont_title
 * @property integer $cont_type
 * @property string $cont_czid
 * @property string $cont_created_time
 */
class WxYhtContract extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_yht_contract}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['cont_owner_signerId', 'cont_has_bind', 'cont_status', 'cont_type'], 'integer'],
            [['cont_created_time'], 'safe'],
            [['cont_contractId', 'cont_templateId', 'cont_czid'], 'string', 'max' => 32],
            [['cont_title'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cont_id' => 'Cont ID',
            'cont_contractId' => '合同 ID',
            'cont_owner_signerId' => '创建人云平台id',
            'cont_templateId' => '模版 id',
            'cont_has_bind' => '判断合同是否绑定 0.未绑定,还可转发 1.绑定,不可继续转发 2.锁定,只能甲乙双方操作',
            'cont_status' => '签署者状态：0 待签署，1 已签署',
            'cont_title' => '合同名',
            'cont_type' => '合同所属类型(暂废)',
            'cont_czid' => '存证 id',
            'cont_created_time' => '创建时间',
        ];
    }
}
