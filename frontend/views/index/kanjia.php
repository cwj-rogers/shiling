<?php
use \yii\helpers\Url;
?>
<div class="row">
    <div id="sectionA">
        <img src="http://hjzhome.image.alimmdn.com/%E9%A6%96%E9%A1%B5%E5%9B%BE%E7%89%87/9.9%E7%A0%8D%E4%BB%B7.jpg" alt="">
    </div>
    <div id="sectionB" class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div>王女士 [<em> 大力出奇迹 </em>] <span>2</span>刀砍价成功 <<strong> 智能马桶 </strong>> </div>
    </div>
    <div class="kj-title col-xs-12 col-sm-12 col-md-12 col-lg-12"><h4 ><i class="kj-title-before"></i>热门砍价商品<i class="kj-title-after"></i></h4></div>

    <?php foreach ([1,2,3,4,5,6,7] as $k=>$v):?>
    <div class="goods col-xs-12 col-sm-12 col-md-6 col-lg-6 blank">
        <a class="go-detail" href="<?= Url::toRoute('detail')?>">
            <div class="left"><img src="https://img.alicdn.com/imgextra/https://img.alicdn.com/imgextra/i1/498837070/TB2cJgdhtcnBKNjSZR0XXcFqFXa_!!498837070.jpg_430x430q90.jpg" alt=""></div>
            <div class="right">
                <div class="r-top">
                    <div class="rt-title">#北欧风简约沙发#
                        <span class="rt-secondtitle text-muted"> 驼色简约皮面,手感柔软做工精细,人体工程学最佳坐姿角度...</span>
                    </div>
                </div>
                <div class="r-bottom">
                    <div class="rb-left">
                        <small class="text-muted">2090人已砍价成功</small>
                        <span><s>原价1190元</s></span>
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
    <?php endforeach;?>

    <div class="loading-all col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <i class="la-title-before"></i>已经没有更多了<i class="la-title-after"></i>
    </div>
</div>

