<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\WxGoods */

$this->title = $model->wg_id;
$this->params['breadcrumbs'][] = ['label' => 'Wx Goods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="wx-goods-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->wg_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->wg_id], [
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
            'wg_id',
            'wg_name',
            'wg_description',
            'wg_content:ntext',
            'wg_goods_album',
            'wg_market_price',
            'wg_number',
            'wg_view',
            'wg_finish_deal',
            'wg_need_cut',
            'wg_type',
            'wg_status',
            'wg_promote_time',
            'wg_sort',
            'created_time',
            'updated_time',
        ],
    ]) ?>

</div>
