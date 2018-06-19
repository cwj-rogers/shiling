<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WxGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wx-goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wg_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_description')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_content')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'wg_goods_album')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_market_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_number')->textInput() ?>

    <?= $form->field($model, 'wg_view')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_finish_deal')->textInput() ?>

    <?= $form->field($model, 'wg_need_cut')->textInput() ?>

    <?= $form->field($model, 'wg_type')->textInput() ?>

    <?= $form->field($model, 'wg_status')->textInput() ?>

    <?= $form->field($model, 'wg_promote_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_sort')->textInput() ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <?= $form->field($model, 'updated_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
