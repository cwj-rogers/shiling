<?php

use \yii\helpers\Url;
use \yii\widgets\Pjax;
?>
<div id="user" class="row">
    <div class="avatar-box col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="avatar"><img src="http://hjzhome.image.alimmdn.com/%E7%A0%8D%E4%BB%B7%E6%B4%BB%E5%8A%A8/%E5%BE%AE%E4%BF%A1%E5%9B%BE%E7%89%87_20180611094043.jpg@294w_294h_1l?spm=a312x.7755591.0.0.26384e08j8RF1R&file=%E5%BE%AE%E4%BF%A1%E5%9B%BE%E7%89%87_20180611094043.jpg@294w_294h_1l" alt=""></div>
        <div class="name">阿斯蒂芬卢卡斯积分</div>
    </div>

<!--  pjax刷新我的订单  -->
    <?php Pjax::begin(); ?>
    <div class="myorder">
        <div class="myorder-title">
            <span>我的订单</span>
            <span class="glyphicon glyphicon-chevron-right"></span>
        </div>
        <div class="order-status">
            <div class="going"><a href="<?= Url::toRoute("user")?>" class="active"><span class="glyphicon glyphicon-time"></span> 进行中 </a></div>
            <div class="finish"><a href="<?= Url::toRoute("user")?>" class=""><span class="glyphicon glyphicon-check"></span> 已完成 </a></div>
        </div>
    </div>
    <?php foreach ([1,2,3,4,5,6,7] as $k=>$v):?>
    <div class="goods orders-box col-xs-12 col-sm-12 col-md-12 col-lg-12 blank">
        <a class="go-detail" href="<?= $k>2? Url::toRoute('index'):Url::toRoute('detail');?>">
            <div class="left">
                <img src="https://img.alicdn.com/imgextra/https://img.alicdn.com/imgextra/i1/498837070/TB2cJgdhtcnBKNjSZR0XXcFqFXa_!!498837070.jpg_430x430q90.jpg" alt="">
                <div class="fail-mask <?= $k>2?" ":"hide";?>">砍价失败</div>
            </div>
            <div class="right">
                <div class="r-top">
                    <div class="rt-title">#北欧风简约沙发#
                        <span class="rt-secondtitle text-muted"> 驼色简约皮面,手感柔软做工精细,人体工程学最佳坐姿角度...</span>
                    </div>
                </div>
                <div class="r-bottom">
                    <div class="rb-left">
                        <small class="text-muted"><?= $k>2?" ":"距离砍价成功";?></small>
                        <span><strong><?= $k>2?"砍价失败":"还差1190元";?></strong></span>
                    </div>
                    <div class="rb-right">
                        <div id="<?= "cd-".$k?>" class="count-down <?= $k>2?" ":"cd-item";?>" cd-date="<?= date("Y-m-d H:i:s",time()+192000)?>" cd-name="<?= '#cd-'.$k?>"></div>
                        <button class="btn btn-danger" type="button">
                            <span><?= $k>3?"重砍一个":"继续砍价";?></span>
                        </button>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <?php endforeach;?>
    <?php Pjax::end(); ?>
</div>