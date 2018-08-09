<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionA">
    <header>
        <p>云合同签署平台</p>
    </header>
    <div class="weui-grids">
        <?php foreach ($list as $k=>$v):?>
        <a href="<?= Url::toRoute(['yht/template-form',"tid"=>$v['templateId'],'formName'=>$v['form_name'],'tmp_name'=>$v['tmp_name']])?>" class="weui-grid js_grid">
            <div class="weui-grid-icon">
                <svg class="icon" aria-hidden="true">
                    <use xlink:href="#icon-qianhetong"></use>
                </svg>
            </div>
            <p class="weui-grid__label">
                <?= $v['tmp_name']?>
            </p>
        </a>
        <?php endforeach;?>
    </div>
</div>