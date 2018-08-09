<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div class="sectionC">
    <div class="weui-msg">
        <div class="weui-msg__icon-area"><i class="weui-icon-success weui-icon_msg"></i></div>
        <div class="weui-msg__text-area">
            <h2 class="weui-msg__title">签署成功</h2>
            <p class="weui-msg__desc">恭喜您，成功签署<span style="color: #0a6aa1">《<?= $title?>》</span>！双方合同受《电子签名法》等法律条款保障，符合法律法规对电子合同有效性和合法性的规定。
                 <a href="<?= Url::toRoute(['yht/contract-detail','contractId'=>$contractId])?>">查看合同</a></p>
        </div>
        <div class="weui-msg__opr-area">
            <p class="weui-btn-area">
                <a href="<?= Url::toRoute(['yht/contract-detail','contractId'=>$contractId])?>" class="weui-btn weui-btn_primary">查看合同详情</a>
                <a href="//www.hjzhome.com" class="weui-btn weui-btn_default">访问官网</a>
            </p>
        </div>
<!--        <div class="weui-msg__extra-area">-->
<!--            <div class="weui-footer">-->
<!--                <p class="weui-footer__links">-->
<!--                    <a href="//www.hjzhome.com" class="weui-footer__link">荟家装云合同平台</a>-->
<!--                </p>-->
<!--                <p class="weui-footer__text">Copyright © 2018-2020 hjzhome</p>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</div>


