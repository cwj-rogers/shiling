<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WxGoods */

$this->title = '创建砍价商品';
$this->params['breadcrumbs'][] = ['label' => 'Wx Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-goods-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
