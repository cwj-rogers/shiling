<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WxGoods */

$this->title = 'Create Wx Goods';
$this->params['breadcrumbs'][] = ['label' => 'Wx Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-goods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
