<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_yht_contract}}".
 *
 * @property integer $cont_id
 * @property string $cont_czid
 * @property string $cont_templateId
 * @property string $cont_contractId
 * @property string $cont_signers
 * @property string $cont_status
 * @property string $cont_created_time
 * @property string $cont_has_signer
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
            [['cont_created_time','cont_has_signer'], 'safe'],
            [['cont_czid', 'cont_templateId', 'cont_contractId', 'cont_status'], 'string', 'max' => 32],
            [['cont_signers'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'cont_id' => 'Cont ID',
            'cont_czid' => '存证 id',
            'cont_templateId' => '模版 id',
            'cont_contractId' => '合同 ID',
            'cont_signers' => '签署者',
            'cont_status' => '签署者状态：0 未签署，1 已签署',
            'cont_created_time' => '创建时间',
            'cont_has_signer' => '是否有签署者'
        ];
    }
}
