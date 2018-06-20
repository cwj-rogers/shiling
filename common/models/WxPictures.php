<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%wx_pictures}}".
 *
 * @property integer $wp_id
 * @property string $wp_url
 * @property string $wp_jump_url
 * @property integer $wp_status
 * @property integer $wp_sort
 * @property string $created_time
 */
class WxPictures extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wx_pictures}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['wp_url', 'wp_jump_url'], 'required'],
            [['wp_status', 'wp_sort'], 'integer'],
            [['created_time'], 'safe'],
            [['wp_url', 'wp_jump_url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'wp_id' => 'Wp ID',
            'wp_url' => '图片地址',
            'wp_jump_url' => '跳转地址',
            'wp_status' => '状态 1.上架 0.下架',
            'wp_sort' => '越小越靠前',
            'created_time' => 'Created Time',
        ];
    }
}
