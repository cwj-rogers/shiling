<?php
use yii\helpers\Url;
?>
<script type="text/javascript" charset="utf-8">
    // 微信分享的数据
    wx.ready (function () {
        //url要完整路径
        var $wx_share = [
            <?= json_encode($res['wg_thumb'])?>,
            <?= json_encode(Url::toRoute(['index/detail','wg_id'=>$res['wg_id'],'user_id'=>$res['user_id'],'ago_id'=>$res['ago_id']], true));?>,
            <?= json_encode($res['wg_name'])?>,
            <?= json_encode($res['wg_title'])?>
        ];
        // 微信分享的数据
        var shareData = {
            "imgUrl" : $wx_share[0],    // 分享显示的缩略图地址
            "link" : $wx_share[1],    // 分享地址
            "title" : $wx_share[2],   // 分享标题
            "desc" : $wx_share[3],   // 分享描述
            success : function () {
                kanjia.share();
            }
        };
        wx.onMenuShareTimeline (shareData);
        wx.onMenuShareAppMessage (shareData);
        wx.getLocation({
            type: 'wgs84', // 默认为wgs84的gps坐标，如果要返回直接给openLocation用的火星坐标，可传入'gcj02'
            success: function (res) {
                var latitude = res.latitude; // 纬度，浮点数，范围为90 ~ -90
                var longitude = res.longitude; // 经度，浮点数，范围为180 ~ -180。
                sessionStorage.latitude = latitude;
                sessionStorage.longitude = longitude;
                console.log(res);
                getLocation(latitude+','+longitude);
            }
        });
    });
</script>
<div id="detail" class="row" ago-id="<?= $res['ago_id']?>">
    <div class="kj-good-img">
        <div class="swiper-container">
            <div class="swiper-wrapper">
                <?php foreach (explode(',',$res['wg_goods_album']) as $k=>$v):?>
                    <div class="swiper-slide">
                        <img src="<?= $v?>" alt="">
                    </div>
                <?php endforeach;?>
            </div>
            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <div class="ago-location">发起: <?= $res['ago_city']?></div>
    </div>
    <div class="good-title-box col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="good-title"><?= $res['wg_name']?></div>
        <div class="good-price"><s>¥ <?= $res['wg_market_price']?></s></div>
        <div class="act-rule">活动规则</div>
    </div>

    <div class="kj-introduce col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="kj-success-num text-muted">
            <?= $res['wg_finish_deal']?>人已经砍价成功
            <div class="cut-off-date"></div>
        </div>
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
            <?php if($res['ago_status']==2):?>
                <button class="kj-success-btn"><span class="glyphicon glyphicon-check" aria-hidden="true"></span> <span> 砍价成功</span></button>
            <?php elseif($res['isVisit']):?>
                <button class="kj-going-btn"><span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span> <span> 开始砍价</span></button>
            <?php elseif($res['ago_status']==1 && $res['ago_share_kanjia']==0):?>
                <button class="kj-going-btn"><span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span> <span> 开始砍价</span></button>
            <?php else:?>
                <button class="kj-share-btn"><span class="glyphicon glyphicon-share" aria-hidden="true"></span> <span> 喊好友来砍一刀</span></button>
            <?php endif;?>
        </div>
        <div class="kj-friends">
            <div class="join-num">已有 <span class="text-danger"><?= $res['joiners_count'];?></span> 人帮你砍价</div>
            <div class="join-chatheads">
                <?php foreach (array_slice($res['joiners'], 0, 14) as $k=>$v):?>
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
            <div class="weui_cells" sname="share-friends">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>转发好友</p>
                    </div>
                </div>
            </div>
            <div class="weui_cells" sname="share-quan">
                <div class="weui_cell">
                    <div class="weui_cell_bd weui_cell_primary">
                        <p>发到朋友圈</p>
                    </div>
                </div>
            </div>
            <div class="weui_cells" sname="share-link">
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
        <div class="share-icon-box">
            <div class="icon-box animated share-index">
                <img src="http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/share-kj.png" alt="">
            </div>
            <div class="icon-box animated share-friends">
                <p class="how">点击&nbsp <i class="iconfont icon-sandian"></i> &nbsp并在弹窗中选择</p>
                <i class="iconfont icon-fasong"></i>
            </div>
            <div class="icon-box animated share-quan">
                <p class="how">点击 <i class="iconfont icon-sandian"></i> 并在弹窗中选择</p>
                <i class="iconfont icon-iconfontzhizuobiaozhunbduan36"></i>
            </div>
            <div class="icon-box animated share-link">
                <p class="how">点击 <i class="iconfont icon-sandian"></i> 并在弹窗中选择</p>
                <i class="iconfont icon-fuzhilianjie"></i>
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
            <span class="cancel glyphicon glyphicon-remove"></span>
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
                            <div class="talk">来一起帮忙砍价 !</div>
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

    <!--  toast提示  -->
    <div id="toast" style="display: none;">
        <div class="weui_mask_transparent"></div>
        <div class="weui_toast">
            <i class="weui_icon_toast"></i>
            <p class="weui_toast_content">分享给好友即可获得砍价机会</p>
        </div>
    </div>

    <!--  砍价动画  -->
    <div id="kj-success" class="weui_dialog_alert">
        <div class="weui_mask"></div>
        <div class="weui_dialog animated">
            <div class="kj-gif animated"><img src="http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/kj.gif" alt=""></div>
            <div class="kj-info-box animated">
                <p class="kj-info-title"> 您已砍 <strong class="text-danger">20.12</strong> 元, 再送您一次挥刀拿宝的机会, 分享好友有机会一刀砍到最底价!</p>
                <p class="kj-info-share">
                    <button class="btn btn-danger">分享好友,再砍一刀</button>
                </p>
            </div>
            <span class="cancel glyphicon glyphicon-remove "></span>
        </div>
        <button class="kj-ready"></button>
        <audio id="player" controls="controls">
            <source src="<?=Yii::getAlias('@web')?>/static/kanjia.mp3"/>
        </audio>
    </div>

</div>
<script>
    //砍价处理对象
    var kanjia = {};
    kanjia.url = <?= json_encode(Url::toRoute(['index/kj','agoId'=>$res['ago_id'],'userId'=>$res['user_id']]));?>;
    kanjia.indexurl = <?= json_encode(Url::toRoute(['index']) )?>;
    kanjia.shareurl = <?= json_encode(Url::toRoute(['index/share','agoId'=>$res['ago_id'],'userId'=>$res['user_id']]) )?>;
    kanjia.cutOffDate = <?= json_encode($res['ago_exprice_time']) ?>;
    kanjia.kj = function () {
        // console.log('ajax发起砍价');
        var res = 0;
        // 只有同步请求才能促发音频
        $.ajax({
            url: this.url,
            type: 'GET',
            data: {lat:sessionStorage.latitude,lon:sessionStorage.longitude},
            dataType: 'json',
            async: false,
            success: function(data){
                // console.log('ajax返回数据');
                if (data.code==200){
                    res = 1;
                    cut_total = data.obj;
                    $("#kj-success .text-danger").text(data.obj);
                    // console.log(data);
                }else{
                    alert(data.msg);//弹出错误
                    location.href = location.href;
                }
            }
        });
        if(1 == res){
            // console.log('砍价成功');
            $('.kj-ready').trigger("click");
        }
    };
    kanjia.share = function () {
        // console.log('用户分享记录');
        $.getJSON(kanjia.shareurl,function (data) {
            toast("分享成功");
            share_time = 1;//自己已分享
            hasVisitShare = 1;//朋友已分享
        });
    };

    //协助前端判断参数
    var share_time = <?= $res['ago_share_time']?>;var cut_total = <?= $res['ago_cut_total']?>;var status = <?= $res['ago_status']?>;var isVisit = <?= $res['isVisit']?>;var share_kanjia = <?= $res['ago_share_kanjia']?>;var hasVisitShare = <?= $res['hasVisitShare']?>;
    // 用户进入砍价页
    $(function () {
        if(status!=1){
            alert("此商品砍价活动已经结束");
            location.href = kanjia.indexurl;
        }
        //分享弹窗 - 分享行列表
        $('#wx-share .weui_cells').click(function () {
            var sname = $(this).attr("sname");console.log(sname);
            $('.'+sname).siblings(".icon-box").hide();
            $('.'+sname).show().addClass('bounceInUp');
        });

        //开始砍价按钮
        $('#detail').on('click','.kj-going-btn',function () {
            // console.log("点击砍价");
            //砍價资格判断
            if (isVisit==1){
                // 朋友砍价
                if(hasVisitShare==1){
                    kanjia.kj();
                }else{
                    toast("当前页面分享给好友即可获得砍价机会","large");
                }
            }else{
                //只有分享后才能砍价
                if(share_time!=0 && share_kanjia==0){
                    //本人: 第一次分享砍价
                    kanjia.kj();
                }else{
                    toast("当前页面分享给好友即可获得砍价机会","large");
                }
            }
        });

        //取消砍价弹窗后台自动刷新页面
        $('#kj-success .weui_mask, #kj-success .cancel').click(function () {
            setTimeout(function () {
                location.href = location.href;
            },1500)
        });

        //时间截止时间
        countDown('.cut-off-date', kanjia.cutOffDate);
        //砍价排行榜下拉刷新
        // $("#wx-rank-list .cells-box").scroll(function(event){
        //     console.log($(this).scrollTop());
        //     // console.log($(this).offset().top);
        //     if($(this).scrollTop()==300){
        //
        //     }
        // });

        //轮播图
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
    });
</script>
