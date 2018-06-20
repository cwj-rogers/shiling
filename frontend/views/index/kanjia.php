<?php
use \yii\helpers\Url;
?>
<div class="row">
    <div id="sectionA">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach ($slideshow as $k=>$v):?>
                <div class="swiper-slide">
                    <a href="<?= $v['wp_jump_url']? $v['wp_jump_url']:'javascript:;'?>"><img src="<?= $v['wp_url']?>" alt=""></a>
                </div>
                <?php endforeach;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <script>
        $(function () {
            new Swiper('.swiper-container', {
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.swiper-pagination',
                },
                loop:true
            });
        })
    </script>
<!--    <div id="sectionB" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
<!--        <div>王女士 [<em> 大力出奇迹 </em>] <span>2</span>刀砍价成功 <<strong> 智能马桶 </strong>> </div>-->
<!--    </div>-->
    <div class="kj-title col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4 ><i class="kj-title-before"></i>热门砍价商品<i class="kj-title-after"></i></h4>
    </div>

    <?php foreach ($res['goodslist'] as $k=>$v):?>
        <?php if($v['wg_type']==1):?>
        <div class="goods col-xs-12 col-sm-12 col-md-6 col-lg-6 blank">
            <a class="go-detail" href="<?= Url::toRoute(['detail','wg_id'=>$v['wg_id'],'user_id'=>Yii::$app->session->get('userinfo')['user_id']])?>">
                <div class="left"><img src="<?= $v['wg_goods_album']?>" alt=""></div>
                <div class="right">
                    <div class="r-top">
                        <div class="rt-title"><?= $v['wg_name']?>
                            <span class="rt-secondtitle text-muted"> <?= $v['wg_title']?></span>
                        </div>
                    </div>
                    <div class="r-bottom">
                        <div class="rb-left">
                            <small class="text-muted"><?= $v['wg_finish_deal']?>人已砍价成功</small>
                            <span><s>原价<?= $v['wg_market_price']?>元</s></span>
                        </div>
                        <div class="rb-right">
                            <button class="btn btn-danger" type="button">
                                <span>进入砍价</span>
                            </button>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <?php else:?>
            <div class="col-xs-12 col-sm-12 blank advert">
                <img src="<?= $v['wg_goods_album']?>" alt="">
            </div>
        <?php endif;?>
    <?php endforeach;?>

    <div class="loading-all col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <i class="la-title-before"></i>已经没有更多了<i class="la-title-after"></i>
    </div>
</div>

