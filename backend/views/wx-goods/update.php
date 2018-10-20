<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WxGoods */

$this->title = '编辑';
$this->params['breadcrumbs'][] = ['label' => 'Wx Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->wg_id, 'url' => ['view', 'id' => $model->wg_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wx-goods-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
