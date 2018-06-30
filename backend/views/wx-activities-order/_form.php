<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\WxActivitiesOrder */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wx-activities-order-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ago_order_sn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'wg_id')->textInput() ?>

    <?= $form->field($model, 'ago_cut_total')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ago_cut_number')->textInput() ?>

    <?= $form->field($model, 'ago_need_cut')->textInput() ?>

    <?= $form->field($model, 'ago_share_time')->textInput() ?>

    <?= $form->field($model, 'ago_share_kanjia')->textInput() ?>

    <?= $form->field($model, 'ago_status')->textInput() ?>

    <?= $form->field($model, 'ago_payment_method')->textInput() ?>

    <?= $form->field($model, 'ago_province')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ago_city')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ago_take_method')->textInput() ?>

    <?= $form->field($model, 'ago_return_call')->textInput() ?>

    <?= $form->field($model, 'ago_exprice_time')->textInput() ?>

    <?= $form->field($model, 'ago_finish_date')->textInput() ?>

    <?= $form->field($model, 'created_time')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
