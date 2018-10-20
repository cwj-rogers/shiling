<?php

use yii\helpers\Html;
use yii\helpers\Url;
use common\core\ActiveForm;
use common\helpers\ArrayHelper;
use kucha\ueditor\UEditor;

/* @var $this yii\web\View */
/* @var $model common\models\WxGoods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="wx-goods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'wg_name')->textInput(['style'=>'width:100%','maxlength' => true])->label('商品名称简介')->hint('名称+简介两者要用空格隔开,不然报错') ?>

    <?= $form->field($model, 'wg_description')->textarea(['style'=>'width:100%','rows' => 5,'maxlength' => true]) ?>

    <?= $form->field($model, 'wg_goods_album')->textarea(['style'=>'width:100%','rows' => 5])->label('商品图册 (外链接用","隔开)')->hint('图片外链请到<a href="http://wantu.taobao.com" target="_blank">阿里顽兔</a>获取') ?>

    <?= $form->field($model, 'wg_market_price')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'wg_number')->textInput() ?>

    <?=$form->field($model, 'wg_need_cut')->textInput(['class'=>'form-control c-md-1'])->label('需要砍价次数')->hint('需要参与人数')?>

    <?=$form->field($model, 'wg_city')->textInput(['class'=>'form-control c-md-1'])->label('地区')->hint('无限制填"通用",否则填对应城市')?>

    <?=$form->field($model, 'wg_status')->radioList(['1'=>'上架','0'=>'下架'])->label('状态') ?>

    <?=$form->field($model, 'wg_type')->radioList(['1'=>'砍价','2'=>'广告'])->label('类型') ?>

    <?= $form->field($model, 'wg_promote_time')->textInput(['maxlength' => true])->label('多长时间过期')->hint('精确到秒 例:86400(一天)') ?>

    <?=$form->field($model, 'wg_sort')->textInput(['class'=>'form-control c-md-1'])->label('排序值')->hint('排序值越小越前')?>

    <?=
    $form->field($model, 'wg_content')->widget('\kucha\ueditor\UEditor',[
        'clientOptions' => [
            'serverUrl' => Url::to(['/public/ueditor']),//确保serverUrl正确指向后端地址
            'lang' =>'zh-cn', //中文为 zh-cn
            'initialFrameWidth' => '100%',
            'initialFrameHeight' => '400',
            //定制菜单，参考http://fex.baidu.com/ueditor/#start-toolbar
            'toolbars' => [
                [
                    'fullscreen', 'source', 'undo', 'redo', '|',
                    'fontsize',
                    'bold', 'italic', 'underline', 'fontborder', 'strikethrough', 'removeformat',
                    'formatmatch', 'autotypeset', 'blockquote', 'pasteplain', '|',
                    'forecolor', 'backcolor', '|',
                    'lineheight', '|',
                    'indent', '|',
                ],
                ['preview','simpleupload','insertimage','link','emotion','map','insertvideo','insertcode',]
            ]
        ]
    ],['class'=>'c-md-12','style'=>'max-height:5000px'])->label('文章内容');
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
