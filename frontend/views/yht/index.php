<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<div id="sectionD">
    <header>
        <p>云合同列表</p>
    </header>
    <div class="weui-panel weui-panel_access" style="padding-bottom: 100px">
        <div class="weui-panel__hd">我的云合同</div>
        <div class="weui-panel__bd">
            <?php foreach ($list as $k=>$v):?>
            <a href="<?= Url::toRoute(['yht/contract-detail','contractId'=>$v['contractId']])?>" class="weui-media-box weui-media-box_appmsg">
                <div class="weui-media-box__hd">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-qianhetong"></use>
                    </svg>
                </div>
                <div class="weui-media-box__bd">
                    <div class="box__bd-top">
                        <h4 class="weui-media-box__title"><?= $v['title']?></h4> <span><?= $v['gmtCreate']?></span>
                    </div>
                    <div class="box__bd-bottom">
                        <p class="weui-media-box__desc">合同编号: <?= $v['contractId'];?></p>
                        <span class="status<?= $v['status']?>"><?= $v['status']?'已签署':'待签署'?></span>
                    </div>
                </div>
                <div class="weui-media-box__bd arrows">
                    <svg class="icon" aria-hidden="true">
                        <use xlink:href="#icon-jiantou"></use>
                    </svg>
                </div>
            </a>
            <?php endforeach;?>

        </div>
        <div class="weui-loadmore loadmore" style="display: none">
            <i class="weui-loading"></i>
            <span class="weui-loadmore__tips">正在加载</span>
        </div>
        <div class="weui-loadmore weui-loadmore_line" style="display: none">
            <span class="weui-loadmore__tips">已经到底了</span>
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
    <?php if($authority==1 || $authority==2):?>
        <div id="administrator">
            <a href="<?= Url::toRoute(['yht/template'])?>" class="temp"><span>创 建</span><span>合 同</span></a>
        </div>
    <?php endif;?>
</div>
<script>
    $(function () {
        let loadMoreUrl = <?= json_encode(Url::toRoute(['index']))?>;

        var loading = false;  //状态标记
        $(document.body).infinite().on("infinite", function() {
            if(loading) return;
            loading = true;

            $('.loadmore').show();
            let offset = $('.weui-media-box').length;
            let list = "";
            $.getJSON(loadMoreUrl,{offset:offset},function (data) {
                if (data.obj.list.length>0){
                    let arr = data.obj.list;
                    $.each(arr,function (k,v) {
                        var status = v.status==1? '已签署':'待签署';
                        list +=
                            '<a href="<?= Url::toRoute(['yht/contract-detail'])?>?contractId='+v.contractId+'"  class="weui-media-box weui-media-box_appmsg">'+
                            '<div class="weui-media-box__hd">'+
                            '<svg class="icon" aria-hidden="true"><use xlink:href="#icon-qianhetong"></use></svg>'+
                            '</div>'+
                            '<div class="weui-media-box__bd">'+
                                '<div class="box__bd-top">'+
                                    '<h4 class="weui-media-box__title">'+v.title+'</h4>'+
                                    '<span>'+v.gmtCreate+'</span>'+
                                '</div>'+
                                '<div class="box__bd-bottom">'+
                                    '<p class="weui-media-box__desc">合同编号: '+v.contractId+'</p>'+
                                    '<span class="status'+v.status+'">'+status+'</span>'+
                                '</div>'+
                            '</div>'+
                            '<div class="weui-media-box__bd arrows">'+
                            '<svg class="icon" aria-hidden="true"><use xlink:href="#icon-jiantou"></use></svg>'+
                            '</div>'+
                            '</a>';
                    });
                    loading = false;
                    $(".weui-panel__bd").append(list);
                    $('.loadmore').hide();
                }else{
                    loading = true;
                    $(document.body).destroyInfinite(); //可以销毁插件
                    $('.loadmore').hide();
                    $('.weui-loadmore_line').show();
                }
            })
        });

    });
</script>

