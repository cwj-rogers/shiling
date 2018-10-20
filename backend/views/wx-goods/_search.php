<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\search\WxGoodsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wx-goods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'wg_id') ?>

    <?= $form->field($model, 'wg_name') ?>

    <?= $form->field($model, 'wg_description') ?>

    <?= $form->field($model, 'wg_content') ?>

    <?= $form->field($model, 'wg_goods_album') ?>

    <?php // echo $form->field($model, 'wg_market_price') ?>

    <?php // echo $form->field($model, 'wg_number') ?>

    <?php // echo $form->field($model, 'wg_view') ?>

    <?php // echo $form->field($model, 'wg_finish_deal') ?>

    <?php // echo $form->field($model, 'wg_need_cut') ?>

    <?php // echo $form->field($model, 'wg_type') ?>

    <?php // echo $form->field($model, 'wg_status') ?>

    <?php // echo $form->field($model, 'wg_promote_time') ?>

    <?php // echo $form->field($model, 'wg_sort') ?>

    <?php // echo $form->field($model, 'created_time') ?>

    <?php // echo $form->field($model, 'updated_time') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
