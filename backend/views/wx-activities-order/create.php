<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\WxActivitiesOrder */

$this->title = 'Create Wx Activities Order';
$this->params['breadcrumbs'][] = ['label' => 'Wx Activities Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-activities-order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
