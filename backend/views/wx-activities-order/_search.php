<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\WxActivitiesOrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wx-activities-order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'ago_id') ?>

    <?= $form->field($model, 'ago_order_sn') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'wg_id') ?>

    <?= $form->field($model, 'ago_cut_total') ?>

    <?php // echo $form->field($model, 'ago_cut_number') ?>

    <?php // echo $form->field($model, 'ago_need_cut') ?>

    <?php // echo $form->field($model, 'ago_share_time') ?>

    <?php // echo $form->field($model, 'ago_share_kanjia') ?>

    <?php // echo $form->field($model, 'ago_status') ?>

    <?php // echo $form->field($model, 'ago_payment_method') ?>

    <?php // echo $form->field($model, 'ago_province') ?>

    <?php // echo $form->field($model, 'ago_city') ?>

    <?php // echo $form->field($model, 'ago_take_method') ?>

    <?php // echo $form->field($model, 'ago_return_call') ?>

    <?php // echo $form->field($model, 'ago_exprice_time') ?>

    <?php // echo $form->field($model, 'ago_finish_date') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
