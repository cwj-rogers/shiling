<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\search\WxUserSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\WxUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '微信用户';
$this->params['breadcrumbs'][] = $this->title;
/* 先要注册表格所须的资源 */
\backend\assets\TablesAsset::register($this);
?>
<?php
$columns = [
    [
        'header' => 'ID',
        'value' => 'user_id',
        'options' => ['width' => '50px;']
    ],
    [
        'attribute' => 'username',
        'options' => ['width' => '150px;'],
    ],
    [
        'attribute' => 'image',
        'options' => ['width' => '100px;'],
        'content' => function($model){
            return '<img alt="" height="50px" src="'.$model->image.'">';
        }
    ],
    [
        'header' => '状态',
        'attribute' => 'status',
        'options' => ['width' => '100px;'],
        'content' => function($model){
            return WxUserSearch::dropDown('status',$model->status);
        }
    ],
    [
        'attribute' => 'sex',
        'options' => ['width' => '50px;'],
        'content' => function($model){
            return WxUserSearch::dropDown('sex',$model->sex);
        }
    ],

    [
        'header' => '地区',
        'attribute' => 'ago_province',
        'options' => ['width' => '100px;'],
        'content' => function($model){
            return $model->province.'-'.$model->city;
        }
    ],
    [
        'header' => '注册ip',
        'attribute' => 'reg_ip',
        'options' => ['width' => '100px;'],
    ],

    [
        'label' => '注册时间',
        'attribute' => 'reg_time',
        'options' => ['width' => '200px;'],
        'format' =>  ['date', 'php:Y-m-d H:i'],
        'filter' => \kartik\widgets\DatePicker::widget([
            'type' => \kartik\widgets\DatePicker::TYPE_RANGE,
            'language' => 'zh-CN',
            'layout' => '{input1}<br>{input2}',
            'name' => 'WxGoodsSearch[from_date]',
            'value' => $searchModel->from_date,
            'options' =>  ['class'=>'form-control','placeholder' => '开始时间'],
            'name2' => 'WxGoodsSearch[to_date]',
            'value2' => $searchModel->to_date,
            'options2' => ['class'=>'form-control','placeholder' => '结束时间'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd'
            ]
        ])
    ],
];

?>

<div class="portlet light portlet-fit portlet-datatable bordered">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-settings font-dark"></i>
            <span class="caption-subject font-dark sbold uppercase">管理信息</span>
        </div>
        <div class="actions">
            <div class="btn-group btn-group-devided">
                <?=Html::a('清空搜索 <i class="fa fa-times"></i>',['order/index'],['class'=>'btn green','style'=>'margin-right:10px;'])?>
            </div>
            <div class="btn-group">
                <button class="btn blue btn-sm dropdown-toggle" type="button" data-toggle="dropdown">
                    工具箱
                    <i class="fa fa-angle-down"></i>
                </button>
                <ul class="dropdown-menu pull-right" role="menu">
                    <li><a href="javascript:;"><i class="fa fa-pencil"></i> 导出Excel </a></li>
                    <li class="divider"> </li>
                    <li><a href="javascript:;"> 其他 </a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="portlet-body">
        <?php \yii\widgets\Pjax::begin(['options'=>['id'=>'pjax-container']]); ?>
        <div>
            <?php //echo $this->render('_search', ['model' => $searchModel]); ?> <!-- 条件搜索-->
        </div>
        <div class="table-container">
            <form class="ids">
                <?= GridView::widget([
                    'dataProvider' => $dataProvider, // 列表数据
                    'filterModel' => $searchModel, // 搜索模型
                    'options' => ['class' => 'grid-view table-scrollable'],
                    /* 表格配置 */
                    'tableOptions' => ['class' => 'table table-striped table-bordered table-hover table-checkable order-column dataTable no-footer'],
                    /* 重新排版 摘要、表格、分页 */
                    'layout' => '{items}<div class=""><div class="col-md-5 col-sm-5">{summary}</div><div class="col-md-7 col-sm-7"><div class="dataTables_paginate paging_bootstrap_full_number" style="text-align:right;">{pager}</div></div></div>',
                    /* 配置摘要 */
                    'summaryOptions' => ['class' => 'pagination'],
                    /* 配置分页样式 */
                    'pager' => [
                        'options' => ['class'=>'pagination','style'=>'visibility: visible;'],
                        'nextPageLabel' => '下一页',
                        'prevPageLabel' => '上一页',
                        'firstPageLabel' => '第一页',
                        'lastPageLabel' => '最后页'
                    ],
                    /* 定义列表格式 */
                    'columns' => $columns,
                ]); ?>
            </form>
        </div>
        <?php \yii\widgets\Pjax::end(); ?>
    </div>
</div>
