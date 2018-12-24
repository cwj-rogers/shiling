<?php
/* @var $this yii\web\View */
use yii\helpers\Url;
?>
<head>
    <title>荟家装云合同登录</title>
</head>
<style>
    .img-box{padding: 0 125px}
    .img-box .weui-flex__item>p{padding: 0 15px}
    .img-box .weui-flex__item>p span{font-size: 55px;font-weight: bold;border: 1px solid black;padding: 0 20px;}
</style>
<div class="weui-msg" style="padding-top: 15px;">
    <div class="weui-msg__icon-area" style="padding:0 100px;margin-bottom: 10px;">
        <img src="http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/%E4%BA%91%E5%90%88%E5%90%8C/%E4%BA%91X%E8%8D%9F.png?t=1534325733315" alt="">
    </div>

    <?php if (!Yii::$app->wechat->isWechat):?>
        <div class="weui-msg__opr-area">
            <div class="img-box weui-flex">
                <div class="weui-flex__item">
                    <img src="http://hjzhome.image.alimmdn.com/%E5%BE%AE%E4%BF%A1/%E4%BA%91%E5%90%88%E5%90%8C/%E6%89%AB%E7%A0%81%E7%99%BB%E5%BD%95-%E6%AD%A3%E5%BC%8F.png" alt="正式">
                </div>
                <div class="weui-flex__item">
                    <div class="weui-msg__text-area" style="margin-bottom: 10px">
                        <h1 class="weui-msg__title" style="color: #0a6aa1">商家管理后台登录</h1>
                        <p class="weui-msg__desc">请使用手机微信扫码授权登录</p>
                    </div>
                    <p><span><?=$vcode?></span></p>
                    <p class="weui-msg__desc">请在手机端输入验证号码</p>
                </div>
            </div>
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
                <div class="weui-msg__text-area">
                    <input class="weui-input" name="vcode" type="text" placeholder="请输入验证码" value="" style="width: 50%;background-color: papayawhip;padding: 10px;font-size: 24px;font-weight: bold;">
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
            // WX 端脚本
            let qrAuthUrl = <?= json_encode(Url::toRoute(['yht-login/web']))?>;
            $("#qrAuth").popup();
            $("#qrAuth .comfirm-auth").click(function () {
                let vcode = $('.weui-input').val();
                if (!vcode){
                    $.alert('验证码不为空');
                }
                $.showLoading('请求授权');
                $.getJSON(qrAuthUrl,{vcode:vcode,confirm:1},function (data) {
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
            // PC 端脚本
            let req_num = 0;
            let askUrl = <?= json_encode(Url::toRoute(['yht-login/askauth']))?>;
            let vcode = <?= json_encode($vcode)?>;

            var timeHandle = setInterval(function () {
                //限时10分钟授权
                if (req_num<600){
                    $.getJSON(askUrl,{vcode:vcode},function (data) {
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
                    req_num++;
                } else {
                    clearInterval(timeHandle);
                }
            },2000);
        }
    })
</script>

