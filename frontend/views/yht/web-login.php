<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<head>
    <title>荟家装云合同登录</title>
</head>
<div class="weui-msg">
    <div class="weui-msg__icon-area" style="padding:0 50px">
<!--            <i class="weui-icon-waiting weui-icon_msg"></i>-->
        <img src="http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/%E4%BA%91%E5%90%88%E5%90%8C/%E4%BA%91X%E8%8D%9F.png?t=1534325733315" alt="">
    </div>

    <?php if (!Yii::$app->wechat->isWechat):?>
    <div class="weui-msg__text-area">
        <h1 class="weui-msg__title" style="color: #0a6aa1">商家管理后台登录</h1>
<!--        <p class="weui-msg__desc">请填写在云合同平台实名认证过的用户名和手机号</p>-->
        <p class="weui-msg__desc">请使用手机微信扫码授权登录</p>
    </div>
    <div class="weui-msg__opr-area">
        <div class="img-box">
            <img src="http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/%E4%BA%91%E5%90%88%E5%90%8C/%E6%89%AB%E7%A0%81%E7%99%BB%E5%BD%95.png" alt="">
        </div>
<!--        <form action="--><?//= Url::toRoute(['yht-login/web'])?><!--" method="post">-->
<!--            <div class="weui-cells__title">用户名</div>-->
<!--            <div class="weui-cells">-->
<!--                <div class="weui-cell">-->
<!--                    <div class="weui-cell__hd" style="margin-right: 0px">-->
<!--                        <p>用户名：</p>-->
<!--                    </div>-->
<!--                    <div class="weui-cell__bd">-->
<!--                        <input class="weui-input" name="yht_username" type="text" placeholder="用户名 / 公司名称" value="">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="weui-cells__title">手机号</div>-->
<!--            <div class="weui-cells">-->
<!--                <div class="weui-cell">-->
<!--                    <div class="weui-cell__hd" style="margin-right: 0px">-->
<!--                        <p>手机号：</p>-->
<!--                    </div>-->
<!--                    <div class="weui-cell__bd">-->
<!--                        <input class="weui-input" name="yht_phoneNo" type="text" placeholder="11位手机号" value="">-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!---->
<!--            <div class="weui-cell tmp-submit">-->
<!--                <div class="weui-flex" style="width: 100%">-->
<!--                    <div class="weui-flex__item" style="box-sizing: border-box;padding: 0 25px">-->
<!--                        <input type="submit" class="weui-btn weui-btn_primary" value="登录">-->
<!--                    </div>-->
<!--                    <div class="weui-flex__item" style="box-sizing: border-box;padding: 0 25px">-->
<!--                        <a href="--><?//= Url::toRoute(['yht-login/register'])?><!--" class="weui-btn weui-btn_default">注册</a>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="weui-cells__tips">请按真实身份仔细认真填写, 冒认他人信息登录平台将进行法律追究</div>-->
<!--        </form>-->
    </div>
    <div class="weui-cells__tips">请以本人身份登录系统, 冒认他人信息登录平台将进行法律追究</div>
    <?php endif;?>

    <div id="qrAuth" class="weui-popup__container">
        <div class="weui-popup__overlay"></div>
        <div class="weui-popup__modal">
            <div class="weui-msg">
                <div class="weui-msg__icon-area"><i class="weui-icon-waiting weui-icon_msg"></i></div>
                <div class="weui-msg__text-area">
                    <h2 class="weui-msg__title">微信用户点击授权登录</h2>
                </div>
                <div class="weui-msg__opr-area">
                    <p class="weui-btn-area">
                        <a href="javascript:;" class="weui-btn weui-btn_primary comfirm-auth">授权登录</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function () {
        let qrAuth = <?= $qrAuth?>;
        if (qrAuth == 1){
            let qrAuthUrl = <?= json_encode(Url::toRoute(['yht-login/web']))?>;
            let echostr = <?= Yii::$app->request->get('echostr',0)?>;
            // 微信端
            $("#qrAuth").popup();
            $("#qrAuth .comfirm-auth").click(function () {
                $.showLoading('请求授权');
                $.getJSON(qrAuthUrl,{echostr:echostr,confirm:1},function (data) {
                    $.hideLoading('');
                    if (data.code==200){
                        $.toast('授权成功',function () {
                            location.href = "/yht";
                        });
                    } else {
                        $.toast(data.msg);
                    }
                })
            })
        }else {
            let req_num = 0;
            let askUrl = <?= json_encode(Url::toRoute(['yht-login/askauth']))?>;
            let echostr = <?= $echostr?>;
            // PC端
            var timeHandle = setInterval(function () {
                //限时10分钟授权
                if (req_num<600){
                    $.getJSON(askUrl,{echostr:echostr},function (data) {
                        if (data.code==200){
                            clearInterval(timeHandle);
                            $.alert('授权成功',function () {
                                location.href = data.obj;
                            });
                        } else {
                            $.alert(data.msg);
                            clearInterval(timeHandle);
                        }
                    });
                    req_num++
                } else {
                    clearInterval(timeHandle);
                }
            },2000);
        }
    })
</script>

