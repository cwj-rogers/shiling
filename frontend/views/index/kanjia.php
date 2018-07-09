<?php
use \yii\helpers\Url;
?>
<div class="row">
    <div id="sectionA">
        <div class="swiper-container" id="swiper-banner">
            <div class="swiper-wrapper">
                <?php foreach ($slideshow as $k=>$v):?>
                <div class="swiper-slide">
                    <a href="<?= $v['wp_jump_url']? $v['wp_jump_url']:'javascript:;'?>"><img src="<?= $v['wp_url']?>" alt=""></a>
                </div>
                <?php endforeach;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination pagination1"></div>
        </div>
    </div>
    <script>
        $(function () {
            //banner轮播图
            new Swiper('#swiper-banner', {
                autoplay: {
                    delay: 3000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: '.pagination1',
                },
                loop:true
            });
            //砍价广播
            new Swiper('#swiper-radio', {
                direction : 'vertical',
                loop:true,
                // autoplay:true,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                noSwiping : true,
                preventIntercationOnTransition : true,
                allowTouchMove: false,
                // slidesPerView: 1,//设置slider容器能够同时显示的slides数量(carousel模式)。
                // spaceBetween: 1,
                // slidesPerGroup: 1, //在carousel mode下定义slides的数量多少为一组。
                // loopFillGroupWithBlank: true,
            });
        })
    </script>
<!--   广播栏  -->
    <div id="sectionB" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<!--        <div>-->
<!--            <img src="http://thirdwx.qlogo.cn/mmopen/vi_32/cZN9xAaxlYE9TVIej9fVBBKQvvtSfuTVPwyZvj7HRMZQ6icLSPc9T6mTEECqeZ5C1ErnJShRWXGVVn9KZicVcicCg/132" alt="">-->
<!--            又一梦氺 5分钟前 9.9元成功获得 <strong>#北欧布艺简约双人床#</strong>-->
<!--        </div>-->
        <div class="swiper-container" id="swiper-radio">
            <div class="swiper-wrapper">
                    <div class="swiper-slide swiper-no-swiping">
                        <span><img src="http://thirdwx.qlogo.cn/mmopen/vi_32/cZN9xAaxlYE9TVIej9fVBBKQvvtSfuTVPwyZvj7HRMZQ6icLSPc9T6mTEECqeZ5C1ErnJShRWXGVVn9KZicVcicCg/132" alt=""></span>
                        <span>又一梦氺 9.9元成功获得 <strong>#北欧布艺简约双人床#</strong></span> <span>5分钟前</span>
                    </div>
                    <div class="swiper-slide swiper-no-swiping">
                        <span><img src="http://thirdwx.qlogo.cn/mmopen/vi_32/cZN9xAaxlYE9TVIej9fVBBKQvvtSfuTVPwyZvj7HRMZQ6icLSPc9T6mTEECqeZ5C1ErnJShRWXGVVn9KZicVcicCg/132" alt=""></span>
                        <span>又一梦氺 9.9元成功获得 <strong>#北欧布艺简约双人床#</strong></span> <span>5分钟前</span>
                    </div>
                    <div class="swiper-slide swiper-no-swiping">
                        <span><img src="http://thirdwx.qlogo.cn/mmopen/vi_32/cZN9xAaxlYE9TVIej9fVBBKQvvtSfuTVPwyZvj7HRMZQ6icLSPc9T6mTEECqeZ5C1ErnJShRWXGVVn9KZicVcicCg/132" alt=""></span>
                        <span>又一梦氺 9.9元成功获得 <strong>#北欧布艺简约双人床#</strong></span> <span>5分钟前</span>
                    </div>
            </div>
        </div>
    </div>
    <div class="kj-title col-xs-12 col-sm-12 col-md-12 col-lg-12 blank">
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

