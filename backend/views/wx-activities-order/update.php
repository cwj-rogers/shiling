<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\WxActivitiesOrder */

$this->title = 'Update Wx Activities Order: ' . $model->ago_id;
$this->params['breadcrumbs'][] = ['label' => 'Wx Activities Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->ago_id, 'url' => ['view', 'id' => $model->ago_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="wx-activities-order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
