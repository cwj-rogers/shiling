<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\search\WxGoodsSearch;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\WxGoodsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '9.9元砍价';
$this->params['title_sub'] = '砍价活动商品管理列表';  // 在\yii\base\View中有$params这个可以在视图模板中共享的参数
/* 先要注册表格所须的资源 */
\backend\assets\TablesAsset::register($this);
?>
<style>
    .td-img{width: 50px;height: 50px}
</style>
<?php
$columns = [
//    [
//        'class' => \common\core\CheckboxColumn::className(),
//        'name'  => 'id',
//        'options' => ['width' => '20px;'],
//        'checkboxOptions' => function ($model, $key, $index, $column) {
//            return ['value' => $key,'label'=>'<span></span>','labelOptions'=>['class' =>'mt-checkbox mt-checkbox-outline','style'=>'padding-left:19px;']];
//        }
//    ],
    [
        'header' => 'ID',
        'value' => 'wg_id',
        'options' => ['width' => '50px;']
    ],
    [
        'attribute' => 'wg_name',
        'options' => ['width' => '200px;'],
        'content' => function($model){
            return explode(' ',$model->wg_name)[0];
        }
    ],
    [
        'header' => '封面',
        'value' => 'wg_goods_album',
        'content' => function($model){
            $thumb = strstr($model->wg_goods_album, ",", true);
            return'<img alt="" class="td-img" src="'.$thumb.'">';
        },
        'options' => ['width' => '50px;']
    ],
    [
        'header' => '地区',
        'value' => 'wg_city',
        'options' => ['width' => '80px;']
    ],
    [
        'header' => '市场售价',
        'value' => 'wg_market_price',
        'options' => ['width' => '50px;']
    ],
    [
        'header' => '商品总库存',
        'value' => 'wg_number',
        'options' => ['width' => '50px;']
    ],
    [
        'header' => '完成数量',
        'value' => 'wg_finish_deal',
        'options' => ['width' => '50px;']
    ],
    [
        'header' => '需要次数',
        'value' => 'wg_need_cut',
        'options' => ['width' => '50px;']
    ],
    [
        'attribute' => 'wg_status',
        'content' => function($model){
            return WxGoodsSearch::dropDown('wg_status', $model->wg_status);
        },
        'options' => ['width' => '50px;']
    ],
    [
        'attribute' => 'wg_sort',
        'options' => ['width' => '50px;']
    ],
//    [
//        'header' => '起租时间',
//        'value' => 'created_time',
//        'format' => ['date', 'php:Y-m-d'],
//        'options' => ['width' => '100px;'],
//    ],

//    [
//        'label' => '支付状态',
//        'attribute' => 'pay_status',
//        'options' => ['width' => '80px;'],
//        'content' => function($model){
//            return Yii::$app->params['pay_status'][$model['pay_status']];
//        },
//        'filter' => Html::activeDropDownList($searchModel, 'pay_status', [0 => '未支付',1 => '已支付'], ['prompt'=>'全部','class'=>'form-control']),
//    ],
    [
        'label' => '创建时间',
        'attribute' => 'created_time',
        'options' => ['width' => '150px;'],
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
//    [
//        'label' => '支付类型',
//        'attribute' => 'pay_type',
//        'options' => ['width' => '80px;'],
//        'content' => function($model){
//            return Yii::$app->params['pay_type'][$model['pay_type']];
//        },
//        'filter' => Html::activeDropDownList($searchModel, 'pay_type', [1 => '微信',2 => '支付宝',3 => '银联'], ['prompt'=>'全部','class'=>'form-control']),
//    ],
    [
        'class' => 'yii\grid\ActionColumn',
        'header' => '操作',
        'template' => '{edit} {delete}',
        'options' => ['width' => '200px;'],
        'buttons' => [
            'edit' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-edit"></i>', $url, [
                    'title' => Yii::t('app', '编辑'),
                    'class' => 'btn btn-xs purple'
                ]);
            },
            'delete' => function ($url, $model, $key) {
                return Html::a('<i class="fa fa-times"></i>', $url, [
                    'title' => Yii::t('app', '删除'),
                    'class' => 'btn btn-xs red ajax-get confirm'
                ]);
            },
        ],
        'headerOptions' => [],
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
                <?=Html::a('添加商品 <i class="fa fa-plus"></i>',['add','type'=>'shop'],['class'=>'btn green','style'=>'margin-right:10px;'])?>
                <?=Html::a('删除 <i class="fa fa-times"></i>',['delete'],['class'=>'btn green ajax-post confirm','target-form'=>'ids','style'=>'margin-right:10px;'])?>
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
