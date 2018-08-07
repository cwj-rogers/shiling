<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div class="sectionC">
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-warn weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">出错了!</h2>
            <p class="weui-msg__desc"><?= $msg?></p>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
<!--                <a href="--><?//= Url::toRoute(['yht/contract-detail'])?><!--" class="weui-btn weui-btn_primary">查看合同详情</a>-->
                <a href="//www.hjzhome.com" class="weui-btn weui-btn_default">访问官网</a>
            </p>
        </div>
    </div>
</div>


