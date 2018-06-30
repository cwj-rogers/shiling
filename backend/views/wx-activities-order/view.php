<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WxActivitiesOrder */

$this->title = $model->ago_id;
$this->params['breadcrumbs'][] = ['label' => 'Wx Activities Orders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-activities-order-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->ago_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->ago_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'ago_id',
            'ago_order_sn',
            'user_id',
            'wg_id',
            'ago_cut_total',
            'ago_cut_number',
            'ago_need_cut',
            'ago_share_time:datetime',
            'ago_share_kanjia',
            'ago_status',
            'ago_payment_method',
            'ago_province',
            'ago_city',
            'ago_take_method',
            'ago_return_call',
            'ago_exprice_time',
            'ago_finish_date',
            'created_time',
        ],
    ]) ?>

</div>
