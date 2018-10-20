<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_yht_contract_signer}}".
 *
 * @property integer $signer_id
 * @property string $contract_id
 * @property integer $user_id
 * @property integer $is_owner
 */
class WxYhtContractSigner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_yht_contract_signer}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['signer_id'], 'required'],
            [['signer_id', 'user_id', 'is_owner'], 'integer'],
            [['contract_id'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'signer_id' => '云合同用户id',
            'contract_id' => '云合同id',
            'user_id' => '微信用户id',
            'is_owner' => '是否为合同创建人',
        ];
    }
}
