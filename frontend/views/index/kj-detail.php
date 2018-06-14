<?php
use yii\helpers\Url;
?>
<div id="detail" class="row">
    <div class="kj-good-img">
        <img src="http://hjzhome.image.alimmdn.com/%E9%A6%96%E9%A1%B5%E5%9B%BE%E7%89%87/9.9%E7%A0%8D%E4%BB%B7.jpg" alt="">
    </div>
    <div class="good-title-box col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="good-title"><?= $res['wg_name']?></div>
        <div class="good-price"><s>¥ <?= $res['wg_market_price']?></s></div>
        <div class="act-rule">活动规则</div>
    </div>

    <div class="kj-introduce col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="kj-success-num text-muted"><?= $res['wg_finish_deal']?>人已经砍价成功</div>
        <!--  进度条  -->
        <div class="kj-progress">
            <div class="progress">
                <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: <?= $res['centi']?>" data-delay="1000" data-toggle="tooltip" data-placement="top" title="已砍<?= $res['ago_cut_total']?>">
                    <span class="sr-only"></span>
                </div>
            </div>
            <div class="kj-price-box">
                <div class="pb-left text-muted">原价 ¥<?= $res['wg_market_price']?></div>
                <div class="pb-right text-muted">底价 ¥9.9</div>
            </div>
        </div>
        <div class="kj-share">
            <?php if($res['ago_status']==1):?>
            <button class="kj-share-btn"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> <span> 喊好友来砍一刀</span></button>
            <?php else:?>
            <button class="kanjia-success"> <div><span class="glyphicon glyphicon-check" aria-hidden="true"></span> 砍价成功</div><div><small class="text-muted">点击查看兑换门店</small></div></button>
            <?php endif;?>
        </div>
        <div class="kj-friends">
            <div class="join-num">已有 <span class="text-danger"><?= count($res['joiners']);?></span> 人帮你砍价</div>
            <div class="join-chatheads">
                <?php foreach ($res['joiners'] as $k=>$v):?>
                    <span><img src="<?= $v['fj_image']?>" alt=""></span>
                <?php endforeach;?>
            </div>
        </div>
        <div class="kj-rank-list"><a href="#">查看砍价排行榜</a></div>
    </div>
    <div class="good-detail-box col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="good-detail-title"><p>商品详情</p></div>
        <div class="good-detail-introduce">
            <div class="well">
                <p>商品描述</p>
                <p><?= $res['wg_description']?></p>
            </div>
        </div>
        <div class="good-detail">
            <?= $res['wg_content']?>
        </div>
    </div>

    <!--  分享  -->
    <div id="wx-share" class="weui_dialog_alert">
        <div class="weui_mask"></div>
        <div class="weui_dialog animated">
            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>转发好友</p>
                    </div>
                </div>
            </div>
            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>发到朋友圈</p>
                    </div>
                </div>
            </div>
            <div class="weui_cells">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>复制链接</p>
                    </div>
                </div>
            </div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog">取消</a>
            </div>
        </div>
    </div>

    <!--  活动规则  -->
    <div id="wx-rule" class="weui_dialog_alert">
        <div class="weui_mask"></div>
        <div class="weui_dialog animated">
            <h3>活动规则</h3>
            <p>1. 邀请好友一起砍价,帮助砍价成功即可以9.9元获取商品;</p>
            <p>2. 每位好友每天最多帮助您砍价一次;</p>
            <p>3. 活动以城市划分,同一城市好友才有资格帮忙砍价;</p>
            <p>4. 每次砍价金额随机,参与好友越多越容易成功;</p>
            <p>5. 主办方可以根据本活动的实际举办情况对活动规则进行变动或者调整,相关变动或调整将公布在活动页面上,公布后依法生效;</p>
            <p>6. 如有疑问请拨打400-6966-398咨询</p>
            <span class="cancel">×</span>
        </div>
    </div>

    <!--  排行榜  -->
    <div id="wx-rank-list" class="weui_dialog_alert">
        <div class="weui_mask"></div>
        <div class="weui_dialog animated">
            <div class="cells-box">
                <?php foreach ($res['joiners'] as $k=>$v):?>
                    <div class="weui_cells">
                        <div class="orderly"><?= $k+1?>.</div>
                        <div class="wrl-left"><img src="<?= $v['fj_image']?>" alt=""></div>
                        <div class="wrl-mid">
                            <div class="name"><?= $v['fj_user_name']?></div>
                            <div class="talk">来一起帮忙砍价!</div>
                        </div>
                        <div class="wrl-right">砍掉<?= $v['fj_cut_price']?>元</div>
                    </div>
                <?php endforeach;?>
            </div>
            <div class="weui_dialog_ft">
                <a href="javascript:;" class="weui_btn_dialog default">取消</a>
            </div>
            <div class="rank-list-crown"><img src="http://hjzhome.image.alimmdn.com/%E7%A0%8D%E4%BB%B7%E6%B4%BB%E5%8A%A8/%E7%A0%8D%E4%BB%B7%E9%A1%B5_03.png" alt=""></div>
        </div>
    </div>
</div>
<script>
    // 用户进入砍价页
    $(function () {
        var share_time = <?= $res['ago_share_time']?>;
        var cut_total = <?= $res['ago_cut_total']?>;
        var status = <?= $res['ago_status']?>;
        //用户自己首次砍价
        if (cut_total==0 && status==1){
            kanjia.kj();
        }
        //用户第一次分享砍价
    });
    var kanjia = {};
    kanjia.url = <?= json_encode(Url::toRoute(['index/kj','agoId'=>$res['ago_id'],'userId'=>$_SESSION['userinfo']['user_id']]) )?>;
    kanjia.kj = function () {
        $.getJSON(this.url,function (data) {
            console.log(data);
        });
    }
</script>
