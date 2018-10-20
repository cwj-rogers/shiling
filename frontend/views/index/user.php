<?php

use \yii\helpers\Url;
use \yii\widgets\Pjax;
use yii\helpers\Html;
?>
<div id="user" class="row">
    <div class="avatar-box col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="avatar"><img src="<?= $_SESSION['userinfo']['image']?>" alt=""></div>
        <div class="name"><?= $_SESSION['userinfo']['username']?></div>
    </div>

<!--  pjax刷新我的订单  -->
    <div class="myorder">
        <div class="myorder-title">
            <span>我的订单</span>
            <span class="glyphicon glyphicon-chevron-right"></span>
        </div>
        <div class="order-status">
            <div class="going">
                <a href="<?= Url::toRoute(["user",'ago_status'=>1])?>" uri="" class="<?= Yii::$app->request->get('ago_status',1)==1?'active':''?>"><span class="glyphicon glyphicon-time"></span> 进行中 </a>
            </div>
            <div class="finish">
                <a href="<?= Url::toRoute(["user",'ago_status'=>'2,3,4'])?>" uri="" class="<?= Yii::$app->request->get('ago_status',1)==1?'':'active'?>"><span class="glyphicon glyphicon-check"></span> 已完成 </a>
            </div>
        </div>
    </div>

<?php foreach ($res as $k=>$v):?>
    <div class="goods orders-box col-xs-12 col-sm-12 col-md-12 col-lg-12 blank" agoid="<?= $v['ago_id']?>">
        <a class="go-detail" href="<?= $v['ago_status']!=1? Url::toRoute('index'):Url::toRoute(['detail','wg_id'=>$v['wg_id'],'user_id'=>$v['user_id']]);?>">
            <div class="left">
                <img src="<?= $v['wg_goods_album']?>" alt="">
                <div class="fail-mask <?= $v['ago_status']==4?" ":"hide";?>">砍价失败</div>
            </div>
            <div class="right">
                <div class="r-top">
                    <div class="rt-title"><?= $v['wg_name']?>
                        <span class="rt-secondtitle text-muted"> <?= $v['wg_title']?></span>
                    </div>
                </div>
                <div class="r-bottom">
                    <div class="rb-left">
                        <small class="text-muted"><?= $v['ago_status']==1?"距离最低价还差":" ";?></small>
                        <span><strong>¥<?= $v['ago_status']==1? $v['remainPrice']:($v['ago_status']==4?"砍价失败":'砍价成功');?></strong></span>
                    </div>
                    <div class="rb-right">
                        <!-- 活动结束倒计时 -->
                        <?php if ($v['ago_status']==1):?>
                            <div id="<?= "cd-".$k?>" class="count-down cd-item" cd-date="<?= $v['ago_exprice_time']?>" cd-name="<?= '#cd-'.$k?>"></div>
                        <?php endif;?>
                        <button class="btn btn-danger" type="button">
                            <span>
                                <?= $v['ago_status']==1?"继续砍价":"重砍一个";?>
                            </span>
                        </button>
                    </div>
                </div>
            </div>
        </a>
    </div>
<?php endforeach;?>
</div>
<script>

</script>