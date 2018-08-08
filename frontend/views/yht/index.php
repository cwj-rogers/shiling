<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionD">
    <header>
        <p>云合同列表</p>
    </header>
    <div class="weui-panel weui-panel_access">
        <div class="weui-panel__hd">我的云合同</div>
        <div class="weui-panel__bd">
            <?php foreach ($list as $k=>$v):?>
            <a href="<?= Url::toRoute(['yht/contract-detail','contractId'=>$v['contractNo']])?>" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-qianhetong"></use>
                    </svg>
                </div>
                <div class="weui-media-box__bd">
                    <h4 class="weui-media-box__title"><?= $v['title']?> <span><?= $v['gmtCreate']?></span></h4>
                    <p class="weui-media-box__desc">合同编号: <?= $v['contractNo']?></p>
                </div>
                <div class="weui-media-box__bd arrows">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-jiantou"></use>
                    </svg>
                </div>
            </a>
            <?php endforeach;?>
<!--            <a href="javascript:void(0);" class="weui-media-box weui-media-box_appmsg">-->
<!--                <div class="weui-media-box__hd">-->
<!--                    <svg class="icon" aria-hidden="true">-->
<!--                        <use xlink:href="#icon-qianhetong"></use>-->
<!--                    </svg>-->
<!--                </div>-->
<!--                <div class="weui-media-box__bd">-->
<!--                    <h4 class="weui-media-box__title">创客模式合作 <span>2018-07-26</span></h4>-->
<!--                    <p class="weui-media-box__desc">合同编号: 1807261536209921</p>-->
<!--                </div>-->
<!--                <div class="weui-media-box__bd arrows">-->
<!--                    <svg class="icon" aria-hidden="true">-->
<!--                        <use xlink:href="#icon-jiantou"></use>-->
<!--                    </svg>-->
<!--                </div>-->
<!--            </a>-->
        </div>
<!--    底部更多资料    -->
<!--        <div class="weui-panel__ft">-->
<!--            <a href="javascript:void(0);" class="weui-cell weui-cell_access weui-cell_link">-->
<!--                <div class="weui-cell__bd">查看更多</div>-->
<!--                <span class="weui-cell__ft"></span>-->
<!--            </a>-->
<!--        </div>-->
    </div>

    <!--  超级管理员选择跳转  -->
    <div id="super-admin" class="weui-popup__container">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="top">
                <p>合同管理员</p>
                <p>可以根据自己需求选择当前需要使用的功能</p>
            </div>
            <div class="bottom">
                <a href="<?= Url::toRoute(['yht/template'])?>" class="weui-btn weui-btn_primary">去创建新合同</a>
                <a href="javascript:;" class="weui-btn weui-btn_primary close-popup">查看合同列表</a>
            </div>
        </div>
    </div>

</div>
<script type="text/javascript">
    $(function () {
        let authority = <?= $authority?>;
        if (authority===1){
            $("#super-admin").popup();
        }
    });
</script>


